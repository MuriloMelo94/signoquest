<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Votos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'enquete_id'
    ];

    protected $casts = [
        'respostas' => 'json',
    ];

    public function enquete(): BelongsTo
    {
        return $this->belongsTo(Enquetes::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
