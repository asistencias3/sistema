<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionInasistencia extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreUsuario;
    public $fechaInasistencia;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreUsuario, $fechaInasistencia)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->fechaInasistencia = $fechaInasistencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notificacion_inasistencia')
            ->subject('Notificación de Inasistencia');
    }
}
