<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Jornada;
use App\Models\Asistencia;
use Carbon\Carbon;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

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

    return view('Empleados.showJornadas', compact('jornada', 'qrCode')); 
    
}

public function registrar(Request $request)
{
    // Obtener el usuario desde la sesión
    $usuario = User::find(session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'));

    if (!$usuario) {
        return redirect()->route('login')->with('error', 'Debes estar logueado.');
    }

    // Obtener la jornada desde el formulario
    $jornada = Jornada::findOrFail($request->input('jornada_id'));

    // Formatear las horas de entrada y salida de la jornada
    $horaEntrada = Carbon::parse($jornada->hora_entrada)->format('Y-m-d H:i:s');
    $horaSalida = Carbon::parse($jornada->hora_salida)->format('Y-m-d H:i:s');
    
    // Asignar hora_segunda_entrada = hora_salida de jornada
    $horaSegundaEntrada = $horaSalida;

    // Asignar hora_segunda_salida = hora_entrada de jornada
    $horaSegundaSalida = $horaEntrada;

    // Crear y guardar la asistencia
    Asistencia::create([
        'estado' => 1, // Estado: presente
        'id_empleado' => $usuario->id,
        'fecha' => now()->format('Y-m-d'),
        'hora_entrada' => $horaEntrada, // Hora de entrada de la jornada
        'hora_salida' => $horaSalida, // Hora de salida de la jornada
        'hora_segunda_entrada' => $horaSegundaEntrada, // Hora segunda entrada = hora salida de jornada
        'hora_segunda_salida' => $horaSegundaSalida, // Hora segunda salida = hora entrada de jornada
    ]);

    return redirect()->route('empleado.asistencia', $jornada->id)
        ->with('success', 'Asistencia registrada exitosamente.');
}


public function Jornadas()
    {
        $jornadas = Jornada::all(); 
        return view('Empleados.jornadas', compact('jornadas')); 
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
