<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Depense extends Model
{

    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'montant',
        'date',
        'categorie_id',
        'src'

    ];
}
