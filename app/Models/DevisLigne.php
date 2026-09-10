<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevisLigne extends Model
{
    use HasFactory;

    protected $table = 'devis_lignes';

    protected $fillable = [
        'devis_id',
        'product_id',
        'product_name',
        'quantite',
        'prix_unitaire',
        'total_ligne',
    ];

    protected $casts = [
        'quantite'      => 'integer',
        'prix_unitaire' => 'decimal:2',
        'total_ligne'   => 'decimal:2',
    ];

    /**
     * Le devis auquel appartient cette ligne.
     */
    public function devis(): BelongsTo
    {
        return $this->belongsTo(Devis::class);
    }

    /**
     * Le produit référencé par cette ligne.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}