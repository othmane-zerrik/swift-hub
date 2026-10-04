<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function clients()
{
    return $this->hasMany(Client::class);
}

public function fournisseurs()
{
    return $this->hasMany(Fournisseur::class);
}

public function products()
{
    return $this->hasMany(Product::class);
}

public function devis()
{
    return $this->hasMany(Devis::class);
}

public function factures()
{
    return $this->hasMany(Facture::class);
}

public function credits()
{
    return $this->hasMany(Credit::class);
}

public function employees()
{
    return $this->hasMany(Employee::class);
}

public function activities()
{
    return $this->hasMany(Activity::class);
}
}
