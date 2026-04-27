<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasUuids, HasApiTokens, Notifiable;

    protected $connection = 'pgsql_second';
    protected $table = 'users';
    protected $keyType = 'string';

    protected $fillable = [
        'account_id',
        'name',
        'school',
        'grade',
        'sports_profile',
        'primary_goal',
        'current_level',
        'current_xp'
    ];

    public function login(): BelongsTo
    {
        return $this->belongsTo(Login::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
