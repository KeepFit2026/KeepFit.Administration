<?php

namespace App\Services;


class ProgramService extends AbstractApiService
{
    public function endpoint(): string 
    {
        return "programs";
    }
}
