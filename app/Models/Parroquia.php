<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    use HasFactory;

    protected $fillable = ['parroquia'];

    public function municipios(){

    	return $this->belongsTo(Municipio::class);
    	
    }

     public function direccions(){

    	return $this->hasMany(Direccion::class);
    	 
    }
}
