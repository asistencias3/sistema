<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'id_usuario', 
        'nombre', 
        'apellido_paterno', 
        'apellido_materno', 
        'direccion', 
        'telefono',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function empleadoSucursal()
    {
        return $this->hasMany(EmpleadoSucursal::class);
    }

    public function ausencias()
    {
        return $this->hasManyThrough(Ausencia::class, EmpleadoSucursal::class);
    }

    public function asistencias()
    {
        return $this->hasManyThrough(Asistencia::class, EmpleadoSucursal::class);
    }
}
