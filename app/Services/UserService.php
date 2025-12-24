<?php

namespace App\Services;

class UserService extends AbstractApiService 
{
    public function endpoint(): string 
    {
        return "users";
    }
}