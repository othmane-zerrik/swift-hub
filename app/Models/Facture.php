<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';

    protected $fillable = [
        'numero',
        'client_id',
        'devis_id',
        'date_facture',
        'date_echeance',
        'statut',
        'total_ht',
        'total_ttc',
        'notes',
    ];

    protected $casts = [
        'date_facture'  => 'date',
        'date_echeance' => 'date',
        'total_ht'      => 'decimal:2',
        'total_ttc'     => 'decimal:2',
    ];

    /**
     * Le client concerné par cette facture.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Le devis d'origine, si cette facture vient d'un devis (peut être null).
     */
    public function devis(): BelongsTo
    {
        return $this->belongsTo(Devis::class);
    }

    /**
     * Les lignes (produits) de cette facture.
     */
    public function lignes(): HasMany
    {
        return $this->hasMany(FactureLigne::class);
    }

    /**
     * Recalcule et enregistre les totaux à partir des lignes.
     */
    public function recalculerTotaux(): void
    {
        $totalHt = $this->lignes()->sum('total_ligne');

        $this->update([
            'total_ht'  => $totalHt,
            'total_ttc' => $totalHt,
        ]);
    }

    /**
     * Génère le prochain numéro de facture (ex: FAC-2026-0001).
     */
    public static function genererNumero(): string
    {
        $annee = now()->format('Y');
        $dernier = static::where('numero', 'like', "FAC-{$annee}-%")->count();

        return sprintf('FAC-%s-%04d', $annee, $dernier + 1);
    }

    /**
     * Crée une facture à partir d'un devis accepté : copie les lignes
     * et décrémente le stock de chaque produit vendu.
     */
    public static function creerDepuisDevis(Devis $devis): self
    {
        $facture = static::create([
            'numero'        => static::genererNumero(),
            'client_id'     => $devis->client_id,
            'devis_id'      => $devis->id,
            'date_facture'  => now(),
            'date_echeance' => now()->addDays(30),
            'statut'        => 'en_attente',
        ]);

        foreach ($devis->lignes as $ligneDevis) {
            $facture->lignes()->create([
                'product_id'    => $ligneDevis->product_id,
                'product_name'  => $ligneDevis->product_name,
                'quantite'      => $ligneDevis->quantite,
                'prix_unitaire' => $ligneDevis->prix_unitaire,
                'total_ligne'   => $ligneDevis->total_ligne,
            ]);

            // Décrémente le stock du produit vendu
            $product = Product::find($ligneDevis->product_id);
            if ($product) {
                $product->decrement('stock', $ligneDevis->quantite);
            }
        }

        $facture->recalculerTotaux();

        return $facture;
    }
}