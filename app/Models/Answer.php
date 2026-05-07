<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Answer extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'answers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'content',
        'is_correct',
    ];

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'question_quizzes', 'quizz_id');
    }
}
