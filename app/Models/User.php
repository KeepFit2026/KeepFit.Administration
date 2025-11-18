<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'sqlsrv_auth';
    protected $table = 'user';
    public $timestamps = false;

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
}
