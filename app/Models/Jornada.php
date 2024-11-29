<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $table = 'jornadas';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'tipo',
        'hora_entrada',
        'hora_salida',
        'inicio_descanso',
        'fin_descanso',
        'sucursal',
        'qr_code_data', // Campo para la URL del QR
    ];

    public function empleadosSucursales()
    {
        return $this->hasMany(EmpleadoSucursal::class);
    }
}
