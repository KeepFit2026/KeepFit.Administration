<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.Login.{id}', function ($user, $id) {
    return (string) $user->id === (string) $id;
});
