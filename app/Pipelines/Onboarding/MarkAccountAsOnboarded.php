<?php

namespace App\Pipelines\Onboarding;

use Closure;

class MarkAccountAsOnboarded
{
    public function handle($data, Closure $next)
    {
        $user = $data['user'];
        $user->onboarding_completed = true;
        $user->save();
        return $next($data);
    }
}