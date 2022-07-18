<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meta extends Model
{
    use HasFactory,Notifiable, SoftDeletes;
    protected $fillable = [
        'description',
        'user_id',
        'name',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
