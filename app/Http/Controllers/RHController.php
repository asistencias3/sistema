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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class RHController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('empleadoSucursal')
            ->where('estado', 1) // Solo asistencias activas
            ->whereHas('empleadoSucursal', function($query) {
                $query->whereIn('rol', [2, 3]); // Filtra por roles 2 y 3
            })
            ->get();
    
        return view('RH.Index', compact('asistencias'));
    }
    
    public function inasistencias()
    {
       
        $inasistencias = Asistencia::with('empleadoSucursal')
            ->where('estado', 0) // Solo inasistencias
            ->whereHas('empleadoSucursal', function($query) {
                $query->whereIn('rol', [2, 3]); // Filtra por roles 2 y 3
            })
            ->get();
    
        return view('RH.Inasistencias.Index', compact('inasistencias'));
    }
    
    public function create()
    {
        // Mostrar empleados con rol 3, si se requiere crear un nuevo empleado
        $empleados = User::where('rol', 3)->get(); // Solo empleados con rol 3
        return view('RH.Create', compact('empleados'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_empleado_sucursal' => 'required|exists:users,id,rol,3', // Solo permite empleados con rol 3
            'fecha' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'hora_segunda_entrada' => 'nullable|date_format:H:i',
            'hora_segunda_salida' => 'nullable|date_format:H:i',
        ]);
        
        // Verificar si el id_empleado_sucursal es un nuevo empleado
        if ($request->input('nuevo_empleado') == '1') {
            // Crear un nuevo empleado con rol 3
            $nuevoEmpleado = User::create([
                'name' => $request->input('nombre_empleado'),
                'email' => $request->input('email_empleado'),
                'password' => bcrypt($request->input('password_empleado')),
                'rol' => 3, // Asignar rol 3
            ]);
    
            // Asignar el ID del nuevo empleado
            $validated['id_empleado'] = $nuevoEmpleado->id;
        } else {
            $validated['id_empleado'] = $validated['id_empleado_sucursal'];  // Usar el id del empleado existente
        }
    
        // Combinar fechas y horas
        $validated['hora_entrada'] = $this->combineDateAndTime($validated['fecha'], $validated['hora_entrada']);
        $validated['hora_salida'] = $this->combineDateAndTime($validated['fecha'], $validated['hora_salida']);
        $validated['hora_segunda_entrada'] = $validated['hora_segunda_entrada'] 
            ? $this->combineDateAndTime($validated['fecha'], $validated['hora_segunda_entrada']) 
            : null;
        $validated['hora_segunda_salida'] = $validated['hora_segunda_salida'] 
            ? $this->combineDateAndTime($validated['fecha'], $validated['hora_segunda_salida']) 
            : null;
    
        // Asegurarse de que el campo 'estado' sea 1 (indicado como presente)
        $validated['estado'] = 1;  // Se establece el estado como 1 (presente)
    
        // Crear la asistencia
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
    $empleados = User::where('rol', 3)->get(); // Solo empleados con rol 3
    
    $asistencia->hora_entrada = Carbon::parse($asistencia->hora_entrada);
    $asistencia->hora_salida = Carbon::parse($asistencia->hora_salida);
    if ($asistencia->hora_segunda_entrada) {
        $asistencia->hora_segunda_entrada = Carbon::parse($asistencia->hora_segunda_entrada);
    }
    if ($asistencia->hora_segunda_salida) {
        $asistencia->hora_segunda_salida = Carbon::parse($asistencia->hora_segunda_salida);
    }
    return view('RH.Edit', compact('asistencia', 'empleados'));
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
            2 => 'Recursos Humanos',
            3 => 'Empleado',
        ];
    
        return view('RH.Filtro_Pdf_Asistencias', compact('roles'));
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
    
        $pdf = Pdf::loadView('RH.pdf', compact('asistencias', 'rol', 'empleadoId'))
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
    return view('RH.Inasistencias.Index'); 
}
public function obtenerInasistencias(Request $request)
{
    // Validación de las fechas
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');
    // Consulta para obtener los usuarios con rol 2 o 3 y sus inasistencias
    $inasistencias = User::select('users.id', 'users.name', 'users.rol', 'users.email')
        ->whereIn('users.rol', [2, 3]) // Filtrar solo usuarios con rol 2 o 3
        ->with(['asistencias' => function ($query) use ($fechaInicio, $fechaFin) {
            $query->where('estado', 0) // Inasistencias (estado = 0)
                ->whereBetween('fecha', [$fechaInicio, $fechaFin]); // Rango de fechas
        }])
        ->whereHas('asistencias', function ($query) use ($fechaInicio, $fechaFin) {
            $query->where('estado', 0)
                ->whereBetween('fecha', [$fechaInicio, $fechaFin]); // Rango de fechas
        })
        ->get()
        ->map(function ($user) {
            // Asignar nombres a los roles
            $roles = [
                1 => 'Administrador',
                2 => 'Recursos Humanos',
                3 => 'Empleado',
            ];
            $user->rol = $roles[$user->rol] ?? 'Desconocido'; // Asignar rol basado en el número
            // Contar el número total de inasistencias y obtener las fechas
            $user->total_inasistencias = $user->asistencias->count();
            $user->fechas_inasistencias = $user->asistencias->pluck('fecha');
            return $user;
        });
    // Retornar la respuesta en formato JSON
    return response()->json($inasistencias);
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
 
 public function filtroPdfI()
 {
     $roles = [
         2 => 'Recursos Humanos',
         3 => 'Empleado',
     ];
     return view('RH.Inasistencias.Filtro_Pdf_Inasistencias', compact('roles'));
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
    $pdf = Pdf::loadView('RH.Inasistencias.Pdf_Inasistencias', compact('inasistencias', 'rol', 'empleadoId'))
        ->setPaper('a4', 'portrait');
    return $pdf->download('Reporte_Inasistencias.pdf');
}
 
 public function getEmpleadosPorRolI(Request $request)
 {
     $rol = $request->input('rol');
     $empleados = User::where('rol', $rol)->get(['id', 'name']);
     return response()->json($empleados);
 }

public function registrar(Request $request)
{
    
    $usuario = User::find(session('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'));
    if (!$usuario) {
        return redirect()->route('login')->with('error', 'Debes estar logueado.');
    }
    
    $jornada = Jornada::findOrFail($request->input('jornada_id'));
    
    $horaEntrada = Carbon::parse($jornada->hora_entrada)->format('Y-m-d H:i:s');
    $horaSalida = Carbon::parse($jornada->hora_salida)->format('Y-m-d H:i:s');
    
    
    $horaSegundaEntrada = $horaSalida;
   
    $horaSegundaSalida = $horaEntrada;
    
    Asistencia::create([
        'estado' => 1, 
        'id_empleado' => $usuario->id,
        'fecha' => now()->format('Y-m-d'),
        'hora_entrada' => $horaEntrada, 
        'hora_salida' => $horaSalida, 
        'hora_segunda_entrada' => $horaSegundaEntrada, 
        'hora_segunda_salida' => $horaSegundaSalida, 
    ]);
    return redirect()->route('asistencias.index', $jornada->id)
        ->with('success', 'Asistencia registrada exitosamente.');
}


//aqui empieza jornadas
public function indexjornadas()
{
    $jornadas = Jornada::all(); 
    return view('RH.Jornadas.Index', compact('jornadas')); 
}
public function createjornadas()
{
    return view('RH.Jornadas.Create'); 
}

public function storejornadas(Request $request)
{
$validatedData = $request->validate([
    'fecha_inicio' => 'required|date',
    'fecha_fin' => 'required|date',
    'tipo' => 'required|string',
    'hora_entrada' => 'required|date_format:H:i',
    'hora_salida' => 'required|date_format:H:i',
    'inicio_descanso' => 'required|date_format:H:i',
    'fin_descanso' => 'required|date_format:H:i',
    'sucursal' => 'required|string',
]);

$jornada = Jornada::create([
    'fecha_inicio' => $request->fecha_inicio,
    'fecha_fin' => $request->fecha_fin,
    'tipo' => $request->tipo,
    'hora_entrada' => $request->hora_entrada,
    'hora_salida' => $request->hora_salida,
    'inicio_descanso' => $request->inicio_descanso,
    'fin_descanso' => $request->fin_descanso,
    'sucursal' => $request->sucursal,
]);

$jornada->qr_code_data = route('jornada.showjornadas', ['id' => $jornada->id]);

$jornada->save();

return redirect()->route('jornada.indexjornadas')->with('success', 'Jornada creada con éxito!');
}


public function showjornadas($id)
{
    $jornada = Jornada::findOrFail($id); 
    $qrCode = QrCode::size(200)->generate($jornada->qr_code_data); 
    return view('jornada.show', compact('jornada', 'qrCode')); 
}

public function editjornadas($id)
{
    $jornada = Jornada::findOrFail($id);

    return view('jornada.edit', compact('jornada'));
}

public function updatejornadas(Request $request, $id)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date',
        'tipo' => 'required|string',
        'hora_entrada' => 'required|date_format:H:i',
        'hora_salida' => 'required|date_format:H:i',
        'inicio_descanso' => 'required|date_format:H:i',
        'fin_descanso' => 'required|date_format:H:i',
        'sucursal' => 'required|string',
    ]);

    $jornada = Jornada::findOrFail($id); 

    $jornada->update([
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'tipo' => $request->tipo,
        'hora_entrada' => $request->hora_entrada,
        'hora_salida' => $request->hora_salida,
        'inicio_descanso' => $request->inicio_descanso,
        'fin_descanso' => $request->fin_descanso,
        'sucursal' => $request->sucursal,
        'qr_code_data' => route('jornada.show', $jornada->id), 
    ]);

    return redirect()->route('jornada.index')->with('success', 'Jornada actualizada con éxito!');
}

public function destroyjornadas($id)
{
    $jornada = Jornada::findOrFail($id); 

    $jornada->delete();

    return redirect()->route('jornada.index')->with('success', 'Jornada eliminada con éxito!');
}
}