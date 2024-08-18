<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialista;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Direccion;

class EspecialistaController extends Controller
{
    public function indexweb()
    {
        $especialistas = Especialista::all();
        $generos = Genero::all();
        $estados = Estado::all();
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();
        return view('especialistas.index', [
            'especialistas' => $especialistas, 
            'generos' => $generos,
            'estados' => $estados, 
            'municipios' => $municipios, 
            'parroquias' => $parroquias
        ]);
    }
    
    public function index()
    {
        $especialistas = Especialista::all();
        return response()->json($especialistas);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'fecha_nac' => 'required|date|max:10',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:especialistas,email',
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

            Especialista::create([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'especialidad' => $validatedData['especialidad'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'genero_id' => $validatedData['genero_id'],
                'direccion_id' => $direccion->id,
            ]);
        });

        return redirect('/especialistas')->with('success', 'Especialista registrado exitosamente.');
    }

    public function show($id)
    {
        $especialista = Especialista::find($id); 
        return response()->json($especialista); 
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'fecha_nac' => 'required|date|max:10',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:especialistas,email,' . $id,
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);
        
    
        $especialista = Especialista::with('direccion')->find($id); // Cargar la relación
        if (!$especialista) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }
    
        \DB::transaction(function () use ($validatedData, $especialista) {
            // Actualizar dirección
            $direccion = $especialista->direccion; // Ahora debería estar disponible
            if (!$direccion) {
                throw new \Exception('Dirección no encontrada'); // Lanza una excepción si no se encuentra
            }
    
            $direccion->update([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);
    
            // Actualizar especialista
            $especialista->update([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'especialidad' => $validatedData['especialidad'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'genero_id' => $validatedData['genero_id'],
            ]);
        });
    
        return redirect('/especialistas')->with('success', 'Especialista actualizado exitosamente.');
    }
    

    public function destroy($id)
    {
        $especialista = Especialista::with('direccion')->find($id); // Cargar la relación
        if (!$especialista) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }
    
        $direccion = $especialista->direccion; // Ahora debería estar disponible
        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }
    
        \DB::transaction(function () use ($especialista, $direccion) {
            $especialista->delete();
            $direccion->delete();
        });
    
        return response()->json(['message' => 'Especialista eliminado exitosamente.']);
    }
    

}
