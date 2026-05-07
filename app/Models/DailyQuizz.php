<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyQuizz extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'daily_quizzes';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'scheduled_date',
        'quizz_id'
    ];

    public function quizz(): BelongsTo
    {
        return $this->belongsTo(Quizz::class);
    }
}
