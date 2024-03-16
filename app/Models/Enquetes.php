<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquetes extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'data_inicio',
        'data_termino',
        'data_fim'
    ];

    public function perguntas()
    {
        return $this->hasMany(Perguntas::class, 'enquete_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
