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

    $jornada->qr_code_data = route('jornada.show', ['id' => $jornada->id]);

    $jornada->save();

    return redirect()->route('jornada.index')->with('success', 'Jornada creada con éxito!');
}


    public function show($id)
    {
        $jornada = Jornada::findOrFail($id); 
        $qrCode = QrCode::size(200)->generate($jornada->qr_code_data); 
        return view('jornada.show', compact('jornada', 'qrCode')); 
    }

    public function edit($id)
    {
        $jornada = Jornada::findOrFail($id);

        return view('jornada.edit', compact('jornada'));
    }

    public function update(Request $request, $id)
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

    public function destroy($id)
    {
        $jornada = Jornada::findOrFail($id); 

        $jornada->delete();

        return redirect()->route('jornada.index')->with('success', 'Jornada eliminada con éxito!');
    }
}
