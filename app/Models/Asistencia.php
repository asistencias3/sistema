<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $fillable = [
        'id_empleado_sucursal', 
        'fecha', 
        'hora_entrada', 
        'hora_salida', 
        'hora_segunda_entrada', 
        'hora_segunda_salida',
    ];

    public function empleadoSucursal()
    {
        return $this->belongsTo(EmpleadoSucursal::class);
    }

    public function ausencias()
    {
        return $this->belongsToMany(Ausencia::class, 'asistencias_ausencias');
    }

    public function recesos()
    {
        return $this->hasMany(Receso::class);
    }
}
