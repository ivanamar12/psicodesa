<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

     protected $fillable = ['municipio'];

    public function estados(){

    	return $this->belongsTo(Estado::class);
    	
    }

     public function parroquias(){

    	return $this->hasMany(Parroquia::class);
    	 
    }

     public function direccions(){

        return $this->hasMany(Direccion::class);
         
    }
}
