<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'ci', 'fecha_nac', 'especialidad', 'telefono', 'email','genero_id', 'direccion_id'];

    public function direccions(){

    	return $this->belongsTo(Direccion::class);
    	
    }

    public function generos(){

    	return $this->belongsTo(Genero::class);
    	
    }
}
