<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class JornadaController extends Controller
{
    // Muestra una lista de todas las jornadas
    public function index()
    {
        $jornadas = Jornada::all();  // Obtén todas las jornadas (ajusta esto si es necesario)
        return view('jornada.index', compact('jornadas'));  // Devuelve la vista con las jornadas
    }

    // Muestra el formulario para crear una nueva jornada
    public function create()
    {
        return view('jornada.create'); // Retorna la vista para crear jornada
    }

    // Almacena una nueva jornada en la base de datos
    public function store(Request $request)
{
    // Validar los datos de la solicitud
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

    // Crear la jornada
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

    // Ahora que la jornada ha sido creada y tiene un ID, se asigna la URL del QR
    $jornada->qr_code_data = route('jornada.show', ['id' => $jornada->id]);

    // Guardar la URL del QR en la base de datos
    $jornada->save();

    // Redirigir a la vista de listado de jornadas con un mensaje de éxito
    return redirect()->route('jornada.index')->with('success', 'Jornada creada con éxito!');
}



    // Muestra la jornada individual y genera el código QR
    public function show($id)
    {
        $jornada = Jornada::findOrFail($id); // Encuentra la jornada o falla si no existe

        // Generar el código QR con la URL de la jornada
        $qrCode = QrCode::size(200)->generate($jornada->qr_code_data); // Generar QR

        return view('jornada.show', compact('jornada', 'qrCode')); // Retorna la vista con la jornada y QR
    }

    // Muestra el formulario de edición de jornada
    public function edit($id)
    {
        $jornada = Jornada::findOrFail($id);

        return view('jornada.edit', compact('jornada'));
    }

    // Actualiza la jornada en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los datos
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

        $jornada = Jornada::findOrFail($id); // Buscar la jornada

        // Actualizar los datos de la jornada
        $jornada->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'tipo' => $request->tipo,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida' => $request->hora_salida,
            'inicio_descanso' => $request->inicio_descanso,
            'fin_descanso' => $request->fin_descanso,
            'sucursal' => $request->sucursal,
            'qr_code_data' => route('jornada.show', $jornada->id), // Actualizar URL del QR
        ]);

        return redirect()->route('jornada.index')->with('success', 'Jornada actualizada con éxito!');
    }

    // Elimina una jornada de la base de datos
    public function destroy($id)
    {
        $jornada = Jornada::findOrFail($id); // Buscar la jornada

        $jornada->delete(); // Eliminar la jornada

        return redirect()->route('jornada.index')->with('success', 'Jornada eliminada con éxito!');
    }
}
