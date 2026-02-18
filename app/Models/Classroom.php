<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Classroom extends Model
{
    protected $connection = 'sqlsrv_auth';
    protected $table = 'dbo.Classroom';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'Id',
        'Name',
    ];

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

