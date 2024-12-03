<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    // Crear datos para el QR
    $qrData = json_encode([
        'jornada_id' => $jornada->id,
        'fecha_inicio' => $jornada->fecha_inicio,
        'hora_entrada' => $jornada->hora_entrada,
        'hora_salida' => $jornada->hora_salida,
        'sucursal' => $jornada->sucursal
    ]);

    // Generar el código QR
    $jornada->update(['qr_code_data' => $qrData]);

    return redirect()->route('jornada.index')->with('success', 'Jornada creada con éxito!');
}



public function show($id)
{
    $jornada = Jornada::findOrFail($id); 

    // Generar el código QR con la información actual de la jornada
    $qrData = json_encode([
        'jornada_id' => $jornada->id,
        'fecha_inicio' => $jornada->fecha_inicio,
        'hora_entrada' => $jornada->hora_entrada,
        'hora_salida' => $jornada->hora_salida,
        'sucursal' => $jornada->sucursal
    ]);

    $qrCode = QrCode::size(200)->generate($qrData); 

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
