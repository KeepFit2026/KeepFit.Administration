<?php

namespace App\Models;

use App\Enum\Difficulty;
use App\Services\ExerciseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Exercise extends Model
{
    protected $connection = 'sqlsrv_auth';
    protected $table = 'dbo.Exercise';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'Id',
        'Name',
        'Description',
        'muscleGroupId'
    ];

    protected $casts = [
        'difficulty' => Difficulty::class
    ];

    public function delete()
    {
        app(ExerciseService::class)->DeleteAsync($this->Id);
        return parent::delete();
    }

        public function muscleGroup(): BelongsTo
        {
            return $this->belongsTo(MuscularGroup::class, 'muscleGroupId', 'Id');
        }
    
        protected static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                if (empty($model->{$model->getKeyName()})) {
                    $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
                }
            });
        }
    }
    
