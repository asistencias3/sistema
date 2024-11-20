<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntervaloAsistencia extends Model
{
    use HasFactory;

    protected $table = 'intervalos_asistencias';

    protected $fillable = [
        'id_asistencia', 
        'fecha_date', 
        'hora_entrada', 
        'hora_salida',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }
}
