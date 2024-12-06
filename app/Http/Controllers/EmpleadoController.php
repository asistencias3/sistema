<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use App\Models\User;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $usuarios = User::whereDoesntHave('empleado')->get();
    
        return view('Empleados.Index', compact('usuarios'));
    }
    
    public function buscarAsistenciasEmp(Request $request)
{
    $user = auth()->user(); // Obtener el usuario autenticado
    $rol = $user->role; // Obtener el rol del usuario
    $empleado = $user->empleado; // Obtener el empleado relacionado al usuario

    // Si no existe el empleado, muestra un mensaje de error
    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    // Buscar las asistencias del empleado autenticado
    $asistencias = Asistencia::where('id_empleado', $empleado->id) // Filtra las asistencias por ID de empleado
                             ->where('estado', 1) // Solo las asistencias con estado 1
                             ->with('empleadoSucursal') // Incluir la relación con empleadoSucursal
                             ->get();

    return view('Empleados.asistencias', compact('asistencias', 'rol', 'empleado'));
}
public function buscarInAsistenciasEmp(Request $request)
{
    $user = auth()->user(); // Obtener el usuario autenticado
    $rol = $user->role; // Obtener el rol del usuario
    $empleado = $user->empleado; // Obtener el empleado relacionado al usuario

    // Si no existe el empleado, muestra un mensaje de error
    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    // Buscar las asistencias del empleado autenticado
    $asistencias = Asistencia::where('id_empleado', $empleado->id) // Filtra las asistencias por ID de empleado
                             ->where('estado', 0) // Solo las asistencias con estado 1
                             ->with('empleadoSucursal') // Incluir la relación con empleadoSucursal
                             ->get();

    return view('Empleados.inasistencias', compact('asistencias', 'rol', 'empleado'));
}

    


    public function create()
    {
        $usuarios = User::whereDoesntHave('empleado')->get();
    
        return view('Empleados.Create', compact('usuarios'));
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'id_usuario' => 'required|exists:users,id',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'sucursal' => 'required|string|max:100',
    ]);

    Empleado::create([
        'id_usuario' => $validated['id_usuario'],
        'direccion' => $validated['direccion'],
        'telefono' => $validated['telefono'],
        'sucursal' => $validated['sucursal'],
    ]);

    return redirect()->route('empleado.index')->with('success', 'Empleado registrado correctamente.');
}

    
/*
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_empleado_sucursal' => 'required|integer',
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'hora_segunda_entrada' => 'nullable|date_format:H:i',
            'hora_segunda_salida' => 'nullable|date_format:H:i',
        ]);

        Asistencia::create($validated);

        return redirect()->route('asistencias.index')->with('success', 'Asistencia creada con éxito.');
    }

    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        return view('Asistencias.Edit', compact('asistencia'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_empleado_sucursal' => 'required|integer',
            'fecha' => 'required|date',
            'hora_entrada' => 'nullable|date_format:H:i',
            'hora_salida' => 'nullable|date_format:H:i',
            'hora_segunda_entrada' => 'nullable|date_format:H:i',
            'hora_segunda_salida' => 'nullable|date_format:H:i',
        ]);

        $asistencia = Asistencia::findOrFail($id);
        $asistencia->update($validated);

        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada con éxito.');
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada con éxito.');
    }
*/

}
