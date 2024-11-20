<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'id_ausencia', 
        'encabezado', 
        'mensaje', 
        'fecha_creacion',
    ];

    public function ausencia()
    {
        return $this->belongsTo(Ausencia::class);
    }
}
