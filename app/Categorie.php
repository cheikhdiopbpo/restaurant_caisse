<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //

    protected $fillable = ['libelle','description'];

    public function plat(){
        return $this->hasMany(Plat::class);
    }
}
