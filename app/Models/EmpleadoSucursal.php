<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoSucursal extends Model
{
    use HasFactory;

    protected $table = 'empleados_sucursales';

    protected $fillable = [
        'id_empleado', 
        'id_sucursal', 
        'id_jornada',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function ausencias()
    {
        return $this->hasMany(Ausencia::class);
    }
}
