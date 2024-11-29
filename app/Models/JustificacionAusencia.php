<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustificacionAusencia extends Model
{
    use HasFactory;

    protected $table = 'justificaciones_ausencia';

    protected $fillable = [
        'id_asistencias', 
        'fecha_creacion', 
        'motivo',
        'comprobante',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }
}
