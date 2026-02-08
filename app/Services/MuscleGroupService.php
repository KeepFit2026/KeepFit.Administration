<?php

namespace App\Services;


class MuscleGroupService extends AbstractApiService 
{
    protected function endpoint(): string
    {
        return 'groups';
    }
}