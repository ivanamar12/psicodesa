<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
     protected $fillable = ['nombre', 'apellido', 'ci', 'fecha_nac', 'grado', 'telefono', 'email', 'representante_id', 'genero_id', 'direccion_id'];
     
    public function direccion(){

        return $this->belongsTo(Direccion::class);
        
    }

    public function genero(){

        return $this->belongsTo(Genero::class);
        
    }

    public function representante(){

        return $this->belongsTo(Representante::class);
        
    }
}
