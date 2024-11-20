<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustificacionAusencia extends Model
{
    use HasFactory;

    protected $table = 'justificaciones_ausencia';

    protected $fillable = [
        'id_ausencia', 
        'fecha_creacion', 
        'motivo',
    ];

    public function ausencia()
    {
        return $this->belongsTo(Ausencia::class);
    }
}
