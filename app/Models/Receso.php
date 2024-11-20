<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receso extends Model
{
    use HasFactory;

    protected $table = 'recesos';

    protected $fillable = [
        'id_asistencia', 
        'inicio_receso', 
        'fin_receso', 
        'duracion',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }
}
