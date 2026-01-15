<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

class User extends Model
{
    protected $connection = 'sqlsrv_auth';
    protected $table = 'dbo.user';
    public $timestamps = false;
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Name',
        'AccountId',
    ];

    public static function ExistingAccount(string $accountId): bool 
    {
        return self::where('AccountId', $accountId)->exists();
    }

    /**
     * Retourne le nom de l'utilisateur à partir de l'AccountId.
    */
    public static function findNameByAccountId(string $accountId): ?string
    {
        $user = self::where('AccountId', $accountId)->first();
        return $user ? $user->Name : null;
    }

    /**
     * Génère un GUID lors de la création d'un compte (User::Create)
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Si l'ID n'est pas défini, on en génère un
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
