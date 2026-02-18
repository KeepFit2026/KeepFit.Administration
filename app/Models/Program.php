<?php

namespace App\Models;

use App\Services\ProgramService;
use Illuminate\Database\Eloquent\Model;
class Program extends Model
{
    protected $connection = 'sqlsrv_auth';
    protected $table = 'FitnessProgram';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'Id',
        'Name',
        'Description',
        'IsActive'
    ];

    protected $casts = [
        'IsActive' => 'boolean',
    ];

    public function delete()
    {
        app(ProgramService::class)->DeleteAsync($this->Id);
        return parent::delete();
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
