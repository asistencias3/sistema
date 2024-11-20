<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaAusencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias_ausencias';

    protected $fillable = [
        'id_asistencia', 
        'id_ausencia',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }

    public function ausencia()
    {
        return $this->belongsTo(Ausencia::class);
    }
}
