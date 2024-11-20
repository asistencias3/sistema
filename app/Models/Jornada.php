<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $table = 'jornadas';

    protected $fillable = [
        'tipo', 
        'hora_entrada', 
        'hora_salida', 
        'minutos_descanso', 
        'hora_segunda_entrada', 
        'hora_segunda_salida',
    ];

    public function empleadosSucursales()
    {
        return $this->hasMany(EmpleadoSucursal::class);
    }
}
