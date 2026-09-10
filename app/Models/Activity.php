<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
    ];

    /**
     * Enregistre une nouvelle activité.
     * Utilisation : Activity::log('client', 'Nouveau client ajouté : Karim');
     */
    public static function log(string $type, string $description): self
    {
        return static::create([
            'type'        => $type,
            'description' => $description,
        ]);
    }

    /**
     * Renvoie le nom de l'icône SVG à utiliser selon le type.
     * (utilisé dans la vue pour choisir le bon dessin)
     */
    public function getIconAttribute(): string
    {
        return match ($this->type) {
            'client'  => 'user',
            'produit' => 'box',
            'devis'   => 'file',
            'facture' => 'invoice',
            default   => 'dot',
        };
    }
}