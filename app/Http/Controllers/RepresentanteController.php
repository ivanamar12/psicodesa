<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representante;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Direccion;

class RepresentanteController extends Controller
{
    public function indexweb()
    {
        $representantes = Representante::all();
        $generos = Genero::all();
        $estados = Estado::all();
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();
        return view('representantes.index', [
            'representantes' => $representantes, 
            'generos' => $generos,
            'estados' => $estados, 
            'municipios' => $municipios, 
            'parroquias' => $parroquias
        ]);
    }
    
    public function index()
    {
        $representantes = Representante::all();
        return response()->json($representantes);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'fecha_nac' => 'required|date|max:10',
            'grado' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:representantes,email',
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);

        \DB::transaction(function () use ($validatedData) {
            $direccion = Direccion::create([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);

            Representante::create([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'grado' => $validatedData['grado'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'genero_id' => $validatedData['genero_id'],
                'direccion_id' => $direccion->id,
            ]);
        });

        return redirect('/representantes')->with('success', 'Representante registrado exitosamente.');
    }

    public function show($id)
    {
        $representante = Representante::find($id); 
        return response()->json($representante); 
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'fecha_nac' => 'required|date|max:10',
            'grado' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:representantes,email,' . $id,
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);
        
    
        $representante = Representante::with('direccion')->find($id); // Cargar la relación
        if (!$representante) {
            return response()->json(['message' => 'representante no encontrado'], 404);
        }
    
        \DB::transaction(function () use ($validatedData, $representante) {
            // Actualizar dirección
            $direccion = $representante->direccion; // Ahora debería estar disponible
            if (!$direccion) {
                throw new \Exception('Dirección no encontrada'); // Lanza una excepción si no se encuentra
            }
    
            $direccion->update([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);
    
            // Actualizar representante
            $representante->update([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'grado' => $validatedData['grado'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'genero_id' => $validatedData['genero_id'],
            ]);
        });
    
        return redirect('/representantes')->with('success', 'representante actualizado exitosamente.');
    }
    

    public function destroy($id)
    {
        $representante = Representante::with('direccion')->find($id); // Cargar la relación
        if (!$representante) {
            return response()->json(['message' => 'representante no encontrado'], 404);
        }
    
        $direccion = $representante->direccion; // Ahora debería estar disponible
        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }
    
        \DB::transaction(function () use ($representante, $direccion) {
            $representante->delete();
            $direccion->delete();
        });
    
        return response()->json(['message' => 'representante eliminado exitosamente.']);
    }
    

}
