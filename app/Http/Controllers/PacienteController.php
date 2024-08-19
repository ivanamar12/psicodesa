<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Representante;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Direccion;

class PacienteController extends Controller
{
    public function indexweb()
    {
        $pacientes = Paciente::all();
        $representantes = Representante::all();
        $generos = Genero::all();
        $estados = Estado::all();
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();
        return view('pacientes.index', [
            'pacientes' => $pacientes,
            'representantes' => $representantes, 
            'generos' => $generos,
            'estados' => $estados, 
            'municipios' => $municipios, 
            'parroquias' => $parroquias
        ]);
    }
    
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
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
            'email' => 'required|string|email|max:255|unique:pacientes,email',
            'representante_id' => 'required|exists:representantes,id',
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

            Paciente::create([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'grado' => $validatedData['grado'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'representante_id' => $validatedData['representante_id'],
                'genero_id' => $validatedData['genero_id'],
                'direccion_id' => $direccion->id,
            ]);
        });

        return redirect('/pacientes')->with('success', 'Paciente registrado exitosamente.');
    }

    public function show($id)
    {
        $paciente = Paciente::find($id); 
        return response()->json($paciente); 
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
            'email' => 'required|string|email|max:255|unique:pacientes,email,' . $id,
            'representante_id' => 'required|exists:representantes,id',
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);
        
    
        $paciente = Paciente::with('direccion')->find($id); // Cargar la relación
        if (!$paciente) {
            return response()->json(['message' => 'paciente no encontrado'], 404);
        }
    
        \DB::transaction(function () use ($validatedData, $paciente) {
            // Actualizar dirección
            $direccion = $paciente->direccion; // Ahora debería estar disponible
            if (!$direccion) {
                throw new \Exception('Dirección no encontrada'); // Lanza una excepción si no se encuentra
            }
    
            $direccion->update([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);
    
            // Actualizar paciente
            $paciente->update([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'grado' => $validatedData['grado'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'representante_id' => $validatedData['representante_id'],
                'genero_id' => $validatedData['genero_id'],
            ]);
        });
    
        return redirect('/pacientes')->with('success', 'paciente actualizado exitosamente.');
    }
    

    public function destroy($id)
    {
        $paciente = Paciente::with('direccion')->find($id); // Cargar la relación
        if (!$paciente) {
            return response()->json(['message' => 'paciente no encontrado'], 404);
        }
    
        $direccion = $paciente->direccion; // Ahora debería estar disponible
        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }
    
        \DB::transaction(function () use ($paciente, $direccion) {
            $paciente->delete();
            $direccion->delete();
        });
    
        return response()->json(['message' => 'paciente eliminado exitosamente.']);
    }
    

}
