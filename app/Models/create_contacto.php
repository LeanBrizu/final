<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class create_contacto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'contacto';
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];
}
