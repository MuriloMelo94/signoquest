<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opcoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'opcao',
        'pergunta_id',
    ];

    public function pergunta(): BelongsTo
    {
        return $this->belongsTo(Perguntas::class);
    }
}
