<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
