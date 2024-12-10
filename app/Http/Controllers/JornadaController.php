<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class JornadaController extends Controller
{
    public function index()
    {
        $jornadas = Jornada::all(); 
        return view('jornada.index', compact('jornadas')); 
    }
    public function create()
    {
        return view('jornada.create'); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                'tipo' => 'required|string',
                'hora_entrada' => 'required|date_format:H:i',
                'hora_salida' => 'required|date_format:H:i|after:hora_entrada',
                'inicio_descanso' => 'required|date_format:H:i|after:hora_entrada|before:hora_salida',
                'fin_descanso' => 'required|date_format:H:i|after:inicio_descanso|before:hora_salida',
                'sucursal' => 'required|string',
            ],
            [
                'fecha_inicio.before_or_equal' => 'La fecha de inicio debe ser igual o anterior a la fecha de fin.',
                'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
                'hora_salida.after' => 'La hora de salida debe ser posterior a la hora de entrada.',
                'inicio_descanso.after' => 'El inicio del descanso debe ser después de la hora de entrada.',
                'inicio_descanso.before' => 'El inicio del descanso debe ser antes de la hora de salida.',
                'fin_descanso.after' => 'El fin del descanso debe ser después del inicio del descanso.',
                'fin_descanso.before' => 'El fin del descanso debe ser antes de la hora de salida.',
            ]
        );
    
        // Crear la jornada
        $jornada = new Jornada();
        $jornada->fecha_inicio = $request->fecha_inicio;
        $jornada->fecha_fin = $request->fecha_fin;
        $jornada->tipo = $request->tipo;
        $jornada->hora_entrada = $request->hora_entrada;
        $jornada->hora_salida = $request->hora_salida;
        $jornada->inicio_descanso = $request->inicio_descanso;
        $jornada->fin_descanso = $request->fin_descanso;
        $jornada->sucursal = $request->sucursal;
    
        // Generar un token único para la jornada
        $jornada->qr_token = Str::random(32); // Generar un token único de 32 caracteres
        $jornada->save();
    
        // Crear datos para el QR
        $qrData = json_encode([
            'jornada_id' => $jornada->id,
            'fecha_inicio' => $jornada->fecha_inicio,
            'hora_entrada' => $jornada->hora_entrada,
            'hora_salida' => $jornada->hora_salida,
            'sucursal' => $jornada->sucursal,
            'qr_token' => $jornada->qr_token,  // Añadir el token al QR
        ]);
    
        // Generar y guardar el código QR
        $jornada->update(['qr_code_data' => $qrData]);
    
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('jornada.show', $jornada->id)->with('success', 'Jornada creada con éxito!');
    }

public function show($id)
{
    $jornada = Jornada::findOrFail($id); 

    $qrUrl = route('empleado.asistenciasR', [
        'jornada_id' => $jornada->id,
        'hora_salida' => $jornada->hora_salida,
    ]);
    

    $qrCode = QrCode::size(200)->generate($qrData);
    //quiero que este qr me redirija a la vista  "empleado.asistenciasR" con los datos de jornada_id y hora_salida


    return view('jornada.show', compact('jornada', 'qrCode')); 
}


    public function edit($id)
    {
        $jornada = Jornada::findOrFail($id);

        return view('jornada.edit', compact('jornada'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate(
        [
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo' => 'required|string',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i|after:hora_entrada',
            'inicio_descanso' => 'required|date_format:H:i|after:hora_entrada|before:hora_salida',
            'fin_descanso' => 'required|date_format:H:i|after:inicio_descanso|before:hora_salida',
            'sucursal' => 'required|string',
        ],
        [
            'fecha_inicio.before_or_equal' => 'La fecha de inicio debe ser igual o anterior a la fecha de fin.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'hora_salida.after' => 'La hora de salida debe ser posterior a la hora de entrada.',
            'inicio_descanso.after' => 'El inicio del descanso debe ser después de la hora de entrada.',
            'inicio_descanso.before' => 'El inicio del descanso debe ser antes de la hora de salida.',
            'fin_descanso.after' => 'El fin del descanso debe ser después del inicio del descanso.',
            'fin_descanso.before' => 'El fin del descanso debe ser antes de la hora de salida.',
        ]
    );

    // Buscar la jornada por ID
    $jornada = Jornada::findOrFail($id);

    // Actualizar los datos
    $jornada->update([
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'tipo' => $request->tipo,
        'hora_entrada' => $request->hora_entrada,
        'hora_salida' => $request->hora_salida,
        'inicio_descanso' => $request->inicio_descanso,
        'fin_descanso' => $request->fin_descanso,
        'sucursal' => $request->sucursal,
    ]);

    return redirect()->route('jornada.index')->with('success', 'Jornada actualizada con éxito!');
}



    public function destroy($id)
    {
        $jornada = Jornada::findOrFail($id); 

        $jornada->delete();

        return redirect()->route('jornada.index')->with('success', 'Jornada eliminada con éxito!');
    }
}
