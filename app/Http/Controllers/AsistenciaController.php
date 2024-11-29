<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las asistencias con la relación 'empleadoSucursal' (empleado asociado)
        $asistencias = Asistencia::with('empleadoSucursal')->get();

        // Pasar los datos a la vista
        return view('Asistencias.Index', compact('asistencias'));
    }

    public function create()
    {
        // Obtener todos los empleados activos para el select
        $empleados = User::where('activo', 1)->get();
        return view('Asistencias.Create', compact('empleados'));
    }

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
        // Obtener la asistencia a editar y todos los empleados activos
        $asistencia = Asistencia::findOrFail($id);
        $empleados = User::where('activo', 1)->get();
        return view('Asistencias.Edit', compact('asistencia', 'empleados'));
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
}
