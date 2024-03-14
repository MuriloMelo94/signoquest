<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perguntas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pergunta'
    ];

    public function opcoes()
    {
        return $this->hasMany(Opcoes::class);
    }
}