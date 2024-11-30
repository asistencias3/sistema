<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\user;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('empleadoSucursal')->get();
        return view('Asistencias.Index', compact('asistencias'));
    }

    public function create()
    {
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

    public function filtroPdf()
    {
        $roles = [
            1 => 'Administrador',
            2 => 'Recursos Humanos',
            3 => 'Empleado',
        ];
    
        return view('Asistencias.Filtro_Pdf_Asistencias', compact('roles'));
    }
    
    

    public function generarPdf(Request $request)
{
    $filterRol = $request->has('rol') && !empty($request->input('rol'));
    $rol = $request->input('rol');
    $query = Asistencia::query()->with('empleadoSucursal');
    if ($filterRol) {
        $query->whereHas('empleadoSucursal', function ($q) use ($rol) {
            $q->where('rol', $rol);
        });
    }
    $asistencias = $query->get();
    $pdf = Pdf::loadView('Asistencias.Index', compact('asistencias'));
    return $pdf->download('Reporte_Asistencias.pdf');
}

}
