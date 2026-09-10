<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'notes',
    ];

    /**
     * Les produits fournis par ce fournisseur.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Les crédits (dettes) liés à ce fournisseur.
     */
    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }
}