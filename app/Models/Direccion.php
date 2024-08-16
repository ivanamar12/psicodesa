<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

      protected $fillable = ['estado_id', 'municipio_id', 'parroquia_id', 'sector'];

      public function estados(){

    	return $this->belongsTo(Estado::class);
    	
    }

       public function municipios(){

    	return $this->belongsTo(Municipio::class);
    	
    }

       public function parroquias(){

    	return $this->belongsTo(Parroquia::class);
    	
    }

     public function especialistas(){

        return $this->hasMany(Especialista::class);
         
    }

     public function secretarias(){

        return $this->hasMany(Secretaria::class);
         
    }
}
