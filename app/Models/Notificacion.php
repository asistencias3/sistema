<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'id_asistencias', 
        'encabezado', 
        'mensaje', 
        'fecha_creacion',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }
}
