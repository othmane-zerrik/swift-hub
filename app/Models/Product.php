<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'name',
        'sku',
        'category',
        'price',
        'stock',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];
  public const LOW_STOCK_THRESHOLD = 10;

    public function getIsLowStockAttribute(): bool
    {
        return $this->stock <= self::LOW_STOCK_THRESHOLD;
    }

    public function devisLignes(): HasMany
    {
        return $this->hasMany(DevisLigne::class);
    }

    public function factureLignes(): HasMany
    {
        return $this->hasMany(FactureLigne::class);
    }
     public function fournisseur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }
}