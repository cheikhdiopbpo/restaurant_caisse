<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    
   protected  $fillable = ['id_ticket','libelle','qt','prix','date_enreg'];
}
