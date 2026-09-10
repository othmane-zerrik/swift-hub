<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'salary',
        'hire_date',
    ];

    /**
     * Conversions de types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'salary'    => 'decimal:2',
        'hire_date' => 'date',
    ];
}