<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausencia extends Model
{
    use HasFactory;

    protected $table = 'ausencias';

    protected $fillable = [
        'id_empleado_sucursal', 
        'fecha', 
        'estado', 
        'comprobante',
    ];

    public function empleadoSucursal()
    {
        return $this->belongsTo(EmpleadoSucursal::class);
    }

    public function asistencias()
    {
        return $this->belongsToMany(Asistencia::class, 'asistencias_ausencias');
    }

    public function justificaciones()
    {
        return $this->hasMany(JustificacionAusencia::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }
}
