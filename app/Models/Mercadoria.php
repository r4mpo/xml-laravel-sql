<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercadoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'value',
        'codigo',
        'fk_categoria_1',
        'fk_categoria_2',
        'fk_categoria_3',
    ];
}
