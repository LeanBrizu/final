<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mail;
use App\Mail\ContactMail;

/**
 * Clase modelo para los formularios de contacto recibidos en el sitio web.
 *
 * Esta clase representa un contacto y se utiliza para almacenar y gestionar
 * los datos de los formularios de contacto enviados por los usuarios.
 *
 * @property string $nombre    Nombre del remitente del contacto.
 * @property string $apellido  Apellido del remitente del contacto.
 * @property string $email     Dirección de correo electrónico del remitente.
 * @property string $telefono  Número de teléfono del remitente.
 * @property string $mensaje   Mensaje proporcionado por el remitente.
 */
class Contacto extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'contactos';

     /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'mensaje'
    ];

    /**
     * El método "boot" del modelo.
     *
     * Este método se utiliza para definir eventos de modelo, como enviar
     * un correo electrónico cada vez que se crea un nuevo contacto.
     */
    public static function boot ()
    {
        parent::boot();

        // Definir el evento 'created' para el modelo Contacto
        static::created(function ($item) {

            // Dirección de correo electrónico del administrador
            $adminEmail = "leakpo930@gmail.com";

            // Enviar correo electrónico al administrador cuando se crea un nuevo contacto
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
