<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secretaria;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Direccion;

class SecretariaController extends Controller
{
    public function indexweb()
    {
        $secretarias = Secretaria::all();
        $generos = Genero::all();
        $estados = Estado::all();
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();
        return view('secretarias.index', [
            'secretarias' => $secretarias, 
            'generos' => $generos,
            'estados' => $estados, 
            'municipios' => $municipios, 
            'parroquias' => $parroquias
        ]);
    }
    
    public function index()
    {
        $secretarias = Secretaria::all();
        return response()->json($secretarias);
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
            'email' => 'required|string|email|max:255|unique:secretarias,email',
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

            Secretaria::create([
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

        return redirect('/secretarias')->with('success', 'Secretaria registrado exitosamente.');
    }

    public function show($id)
    {
        $secretaria = Secretaria::find($id); 
        return response()->json($secretaria); 
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
            'email' => 'required|string|email|max:255|unique:secretarias,email,' . $id,
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);
        
    
        $secretaria = Secretaria::with('direccion')->find($id); // Cargar la relación
        if (!$secretaria) {
            return response()->json(['message' => 'Secretaria no encontrado'], 404);
        }
    
        \DB::transaction(function () use ($validatedData, $secretaria) {
            // Actualizar dirección
            $direccion = $secretaria->direccion; // Ahora debería estar disponible
            if (!$direccion) {
                throw new \Exception('Dirección no encontrada'); // Lanza una excepción si no se encuentra
            }
    
            $direccion->update([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);
    
            // Actualizar secretaria
            $secretaria->update([
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
    
        return redirect('/secretarias')->with('success', 'Secretaria actualizado exitosamente.');
    }
    

    public function destroy($id)
    {
        $secretaria = Secretaria::with('direccion')->find($id); // Cargar la relación
        if (!$secretaria) {
            return response()->json(['message' => 'secretaria no encontrado'], 404);
        }
    
        $direccion = $secretaria->direccion; // Ahora debería estar disponible
        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }
    
        \DB::transaction(function () use ($secretaria, $direccion) {
            $secretaria->delete();
            $direccion->delete();
        });
    
        return response()->json(['message' => 'secretaria eliminado exitosamente.']);
    }
    

}
