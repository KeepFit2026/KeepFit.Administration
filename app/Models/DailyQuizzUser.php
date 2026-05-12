<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyQuizzUser extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'daily_quizz_users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'daily_quizz_id',
        'time_spent',
        'score',
        'xp_earned'
    ];
}
