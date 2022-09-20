<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mail;
use App\Mail\ContactMail;

class Contacto extends Model
{
    use HasFactory;
    
    protected $table = 'contactos';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'mensaje'
    ];

    public static function boot() {
        parent::boot();
        static::created(function ($item) {
           $adminEmail = "leakpo930@gmail.com";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
