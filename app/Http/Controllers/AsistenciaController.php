<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Jornada;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Mail\NotificacionInasistencia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class AsistenciaController extends Controller
{
    public function index()
{
    $asistencias = Asistencia::with('empleadoSucursal')
        ->where('estado', 1) // Solo asistencias
        ->get();

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
    
        $query = Asistencia::query()
            ->with('empleadoSucursal')
            ->where('estado', 1); // Solo asistencias
    
        if (!empty($rol)) {
            $query->whereHas('empleadoSucursal', function ($q) use ($rol) {
                $q->where('rol', $rol);
            });
        }
    
        if (!empty($empleadoId)) {
            $query->where('id_empleado', $empleadoId);
        }
    
        $asistencias = $query->get();
    
        $pdf = Pdf::loadView('Asistencias.ReportePdf', compact('asistencias', 'rol', 'empleadoId'))
            ->setPaper('a4', 'portrait');
    
        return $pdf->download('Reporte_Asistencias.pdf');
    }
    



    public function getEmpleadosPorRol(Request $request)
{
    $rol = $request->input('rol');
    $empleados = User::where('rol', $rol)->get(['id', 'name']); 

    return response()->json($empleados);
}

public function mostrarInasistenciasView()
{
    return view('Inasistencias'); 
}

public function obtenerInasistencias(Request $request)
{
   
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

   
    $inasistencias = User::select('users.id', 'users.name', 'users.rol', 'users.email')
        ->with(['asistencias' => function ($query) use ($fechaInicio, $fechaFin) {
            $query->where('estado', 0)
                ->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }])
        ->whereHas('asistencias', function ($query) use ($fechaInicio, $fechaFin) {
            $query->where('estado', 0)
                ->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        })
        ->get()
        ->map(function ($user) {
           
            $roles = [
                1 => 'Administrador',
                2 => 'Recursos Humanos',
                3 => 'Empleado',
            ];
            $user->rol = $roles[$user->rol] ?? 'Desconocido';
            $user->total_inasistencias = $user->asistencias->count();
            $user->fechas_inasistencias = $user->asistencias->pluck('fecha');
            return $user;
        });
    return response()->json($inasistencias);
}

 
 public function filtroPdfI()
 {
     $roles = [
         1 => 'Administrador',
         2 => 'Recursos Humanos',
         3 => 'Empleado',
     ];

     return view('Asistencias.Filtro_Pdf_Inasistencias', compact('roles'));
 }

 public function generarPdfI(Request $request)
{
    $rol = $request->input('rol');
    $empleadoId = $request->input('id_empleado');

    $query = Asistencia::query()
        ->with('empleadoSucursal')
        ->where('estado', 0); // Solo inasistencias

    if (!empty($rol)) {
        $query->whereHas('empleadoSucursal', function ($q) use ($rol) {
            $q->where('rol', $rol);
        });
    }

    if (!empty($empleadoId)) {
        $query->where('id_empleado', $empleadoId);
    }

    $inasistencias = $query->get();

    $pdf = Pdf::loadView('Asistencias.Pdf_Inasistencias', compact('inasistencias', 'rol', 'empleadoId'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('Reporte_Inasistencias.pdf');
}


 
 public function getEmpleadosPorRolI(Request $request)
 {
     $rol = $request->input('rol');
     $empleados = User::where('rol', $rol)->get(['id', 'name']);

     return response()->json($empleados);
 }


public function notificarInasistencias()
{
    $inasistencias = Asistencia::where('estado', 0)->get();

    foreach ($inasistencias as $inasistencia) {
        $user = User::find($inasistencia->id_empleado);

        if ($user) {
            Mail::to($user->email)->send(new NotificacionInasistencia($user, $inasistencia));
        }
    }

    return response()->json(['message' => 'Correos enviados para inasistencias detectadas.']);
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

    return redirect()->route('asistencias.index', $jornada->id)
        ->with('success', 'Asistencia registrada exitosamente.');
}


public function showI($id)
{
    $inasistencias = Asistencia::where('user_id', $id)->get();
    return view('inasistencias.show', compact('inasistencias'));
}
public function justificarInasistencia(Request $request)
{
    // Agrega un log para verificar los datos recibidos
    Log::info('Datos recibidos:', $request->all());
    $request->validate([
        'asistencia_id' => 'required|exists:asistencias,id',
    ]);
    $asistenciaId = $request->input('asistencia_id');
    $asistencia = Asistencia::findOrFail($asistenciaId);
    if ($asistencia->estado === 1) {
        return response()->json([
            'message' => 'La asistencia ya está justificada.',
        ], 400);
    }
    $asistencia->estado = 1;
    $asistencia->save();
    return response()->json([
        'message' => 'La inasistencia ha sido justificada con éxito.',
        'asistencia' => $asistencia,
    ]);
}
}
