<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

      protected $fillable = ['estado_id', 'municipio_id', 'parroquia_id', 'sector'];

      public function estado(){

    	return $this->belongsTo(Estado::class);
    	
    }

       public function municipio(){

    	return $this->belongsTo(Municipio::class);
    	
    }

       public function parroquia(){

    	return $this->belongsTo(Parroquia::class);
    	
    }

     public function especialistas(){

        return $this->hasMany(Especialista::class);
         
    }

     public function secretarias(){

        return $this->hasMany(Secretaria::class);
         
    }

    public function representantes(){

      return $this->hasMany(Representante::class);
       
  }
}
