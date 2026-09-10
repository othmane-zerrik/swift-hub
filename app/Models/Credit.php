<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Credit extends Model
{
    use HasFactory;

  
    protected $fillable = [
        'type',
        'tiers_nom',
        'client_id',
        'fournisseur_id',
        'montant',
        'montant_paye',
        'date_credit',
        'date_echeance',
        'notes',
    ];

    protected $casts = [
        'montant'       => 'decimal:2',
        'montant_paye'  => 'decimal:2',
        'date_credit'   => 'date',
        'date_echeance' => 'date',
    ];

    /**
     * Le client lié, si ce crédit est de type "client".
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Combien il reste à rembourser.
     */
    public function getMontantRestantAttribute(): float
    {
        return round($this->montant - $this->montant_paye, 2);
    }

    /**
     * Statut calculé automatiquement : payé / en retard / en cours.
     */
    public function getStatutAttribute(): string
    {
        if ($this->montant_restant <= 0) {
            return 'paye';
        }

        if ($this->date_echeance->isPast()) {
            return 'en_retard';
        }

        return 'en_cours';
    }

    /**
     * Vrai si l'échéance est dans moins de 7 jours (mais pas encore dépassée).
     */
    public function getEcheanceProcheAttribute(): bool
    {
        return $this->statut === 'en_cours'
            && now()->diffInDays($this->date_echeance, false) <= 7;
    }
      public function fournisseur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }
}