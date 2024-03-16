<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perguntas extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'enquete_id'
    ];

    public function opcoes()
    {
        return $this->hasMany(Opcoes::class, 'pergunta_id');
    }

    public function enquete(): BelongsTo
    {
        return $this->belongsTo(Enquetes::class);
    }

}
