<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('empleadoSucursal')->get();
        return view('Asistencias.Index', compact('asistencias'));
    }

    public function create()
    {
        return view('Asistencias.Create');
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
}
