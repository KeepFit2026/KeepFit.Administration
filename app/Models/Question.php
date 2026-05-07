<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'content',
        'difficulty_id',
    ];

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quizz::class, 'question_quizzes', 'question_id', 'quizz_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
