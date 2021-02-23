<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    //

    protected $fillable = ['libelle','description','image','prix'];


    public function categories(){
        return $this->belongsTo(Categorie::class);
    }
}
