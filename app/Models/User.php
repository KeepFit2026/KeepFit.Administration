<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[ObservedBy(UserObserver::class)]
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

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'current_level');
    }

    /**
     * Les quiz quotidiens terminés par l'utilisateur
     */
    public function completedDailyQuizzes()
    {
        return $this->belongsToMany(DailyQuizz::class, 'daily_quizz_users')
                    ->withPivot(['time_spent', 'score', 'xp_earned'])
                    ->withTimestamps();
    }
}
