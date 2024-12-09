<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

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
    $user = auth()->user();
    $rol = $user->role;
    $empleado = $user->empleado; 

    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    // Buscar las asistencias del empleado autenticado
    $asistencias = Asistencia::where('id_empleado', $empleado->id) // Filtra las asistencias por ID de empleado
                             ->where('estado', 1) 
                             ->with('empleadoSucursal') 
                             ->get();

    return view('Empleados.asistencias', compact('asistencias', 'rol', 'empleado'));
}
public function buscarInAsistenciasEmp(Request $request)
{
    $user = auth()->user();
    $rol = $user->role;
    $empleado = $user->empleado; // Obtener el empleado relacionado al usuario

    // Si no existe el empleado, muestra un mensaje de error
    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    $asistencias = Asistencia::where('id_empleado', $empleado->id) 
                             ->where('estado', 0) 
                             ->with('empleadoSucursal') 
                             ->get();

    return view('Empleados.inasistencias', compact('asistencias', 'rol', 'empleado'));
}

public function showJornadas($id){
    $jornada = Jornada::findOrFail($id); 

    $qrData = json_encode([
        'jornada_id' => $jornada->id,
        'fecha_inicio' => $jornada->fecha_inicio,
        'hora_entrada' => $jornada->hora_entrada,
        'hora_salida' => $jornada->hora_salida,
        'sucursal' => $jornada->sucursal
    ]);

    $qrCode = QrCode::size(200)->generate($qrData); 

    return view('empleado.showJornadas', compact('jornada', 'qrCode')); 
}

public function Jornadas()
    {
        $jornadas = Jornada::all(); 
        return view('empleado.jornadas', compact('jornadas')); 
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

    
public function generarPdfAsistencias()
{
    $user = auth()->user();
    $empleado = $user->empleado;

    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    $asistencias = Asistencia::where('id_empleado', $empleado->id)
                             ->where('estado', 1)
                             ->get();

    $pdf = Pdf::loadView('Empleados.PDFasistencias', compact('asistencias'));
    return $pdf->download('asistencias.pdf');
}

public function generarPdfInasistencias()
{
    $user = auth()->user();
    $empleado = $user->empleado;

    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    $inasistencias = Asistencia::where('id_empleado', $empleado->id)
                                ->where('estado', 0)
                                ->get();

    $pdf = Pdf::loadView('Empleados.PDFinasistencias', compact('inasistencias'));
    return $pdf->download('inasistencias.pdf');
}

}
