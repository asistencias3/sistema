<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'direccion',
        'telefono',
        'sucursal',
    ];

    // Relación inversa con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
