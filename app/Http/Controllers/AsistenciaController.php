<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\user;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('empleadoSucursal')->get();
        return view('Asistencias.Index', compact('asistencias'));
    }

    public function create()
{
    $empleados = User::all();
    return view('Asistencias.Create', compact('empleados'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'id_empleado_sucursal' => 'required|exists:users,id', 
        'fecha' => 'required|date',
        'hora_entrada' => 'required|date_format:H:i',
        'hora_salida' => 'required|date_format:H:i',
        'hora_segunda_entrada' => 'nullable|date_format:H:i',
        'hora_segunda_salida' => 'nullable|date_format:H:i',
    ]);

    $validated['hora_entrada'] = $this->combineDateAndTime($validated['fecha'], $validated['hora_entrada']);
    $validated['hora_salida'] = $this->combineDateAndTime($validated['fecha'], $validated['hora_salida']);
    $validated['hora_segunda_entrada'] = $validated['hora_segunda_entrada'] 
        ? $this->combineDateAndTime($validated['fecha'], $validated['hora_segunda_entrada']) 
        : null;
    $validated['hora_segunda_salida'] = $validated['hora_segunda_salida'] 
        ? $this->combineDateAndTime($validated['fecha'], $validated['hora_segunda_salida']) 
        : null;

  
    $validated['id_empleado'] = $validated['id_empleado_sucursal'];  

    
    Asistencia::create($validated);

    return redirect()->route('asistencias.index')->with('success', 'Asistencia creada con éxito.');
}



private function combineDateAndTime($date, $time)
{
   
    return $date . ' ' . $time . ':00';
}

public function edit($id)
{
    $asistencia = Asistencia::findOrFail($id);
    $empleados = User::all();

    
    $asistencia->hora_entrada = Carbon::parse($asistencia->hora_entrada);
    $asistencia->hora_salida = Carbon::parse($asistencia->hora_salida);
    if ($asistencia->hora_segunda_entrada) {
        $asistencia->hora_segunda_entrada = Carbon::parse($asistencia->hora_segunda_entrada);
    }
    if ($asistencia->hora_segunda_salida) {
        $asistencia->hora_segunda_salida = Carbon::parse($asistencia->hora_segunda_salida);
    }

    return view('Asistencias.Edit', compact('asistencia', 'empleados'));
}

    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'id_empleado_sucursal' => 'required|integer|exists:users,id', 
            'fecha' => 'required|date',
            'hora_entrada' => 'nullable|date_format:H:i',
            'hora_salida' => 'nullable|date_format:H:i',
            'hora_segunda_entrada' => 'nullable|date_format:H:i',
            'hora_segunda_salida' => 'nullable|date_format:H:i',
        ]);
    
        
        $asistencia = Asistencia::findOrFail($id);
    
       
        $validated['hora_entrada'] = $this->combineDateAndTime($validated['fecha'], $validated['hora_entrada']);
        $validated['hora_salida'] = $this->combineDateAndTime($validated['fecha'], $validated['hora_salida']);
        $validated['hora_segunda_entrada'] = $validated['hora_segunda_entrada'] 
            ? $this->combineDateAndTime($validated['fecha'], $validated['hora_segunda_entrada']) 
            : null;
        $validated['hora_segunda_salida'] = $validated['hora_segunda_salida'] 
            ? $this->combineDateAndTime($validated['fecha'], $validated['hora_segunda_salida']) 
            : null;
    
       
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
    $rol = $request->input('rol');
    $empleadoId = $request->input('id_empleado');

    $query = Asistencia::query()->with('empleadoSucursal');

    if (!empty($rol)) {
        $query->whereHas('empleadoSucursal', function ($q) use ($rol) {
            $q->where('rol', $rol);
        });
    }

    if (!empty($empleadoId)) {
        $query->where('id_empleado', $empleadoId);
    }

    $asistencias = $query->get();

    $pdf = Pdf::loadView('Asistencias.Index', compact('asistencias'));
    return $pdf->download('Reporte_Asistencias.pdf');
}


    public function getEmpleadosPorRol(Request $request)
{
    $rol = $request->input('rol');

    // Filtrar empleados según el rol seleccionado
    $empleados = User::where('rol', $rol)->get(['id', 'name']); // Ajusta los campos según tu tabla

    return response()->json($empleados);
}

}
