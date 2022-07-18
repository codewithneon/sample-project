<?php

namespace App\Models;

use App\Notifications\UserNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->notify(UserNotification::for('Created Successful', 'Your Account Created Successful'));
        });
        static::updated(function ($model) {
            $model->notify(UserNotification::for('Updated Successful', 'Your Account Updated Successful'));
        });
    }
    
    public function meta(): HasOne
    {
        return $this->hasOne(Meta::class,'user_id')->withDefault();
    }
}
