<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empleado',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'hora_segunda_entrada',
        'hora_segunda_salida',
    ];

    public function empleadoSucursal()
    {
        return $this->belongsTo(User::class, 'id_empleado');
    }

    
}
