<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model

{
    use HasFactory;
    protected $fillable = [ 'name'];

    protected $table = 'categories';
    public function depense()
    {
        return $this->hasMany(Depense::class);
    }
}
