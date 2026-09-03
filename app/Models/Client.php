<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Client extends Model
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
        'city',
        'notes',
    ];
}