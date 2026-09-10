<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Devis extends Model
{
    use HasFactory;

    protected $table = 'devis';

    protected $fillable = [
        'numero',
        'client_id',
        'date_devis',
        'date_validite',
        'statut',
        'total_ht',
        'total_ttc',
        'notes',
    ];

    protected $casts = [
        'date_devis'    => 'date',
        'date_validite' => 'date',
        'total_ht'      => 'decimal:2',
        'total_ttc'     => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function lignes(): HasMany
    {
        return $this->hasMany(DevisLigne::class);
    }

    /**
     * La facture générée à partir de ce devis, s'il y en a une.
     */
    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    public function recalculerTotaux(): void
    {
        $totalHt = $this->lignes()->sum('total_ligne');

        $this->update([
            'total_ht'  => $totalHt,
            'total_ttc' => $totalHt,
        ]);
    }

    public static function genererNumero(): string
    {
        $annee = now()->format('Y');
        $dernier = static::where('numero', 'like', "DEV-{$annee}-%")->count();

        return sprintf('DEV-%s-%04d', $annee, $dernier + 1);
    }
}