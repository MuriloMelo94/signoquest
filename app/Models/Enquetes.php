<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquetes extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo_enquete',
        'data_inicio',
        'data_termino',
        'data_fim'
    ];

    public function perguntas()
    {
        return $this->hasMany(Perguntas::class, 'enquete_id');
    }
}
