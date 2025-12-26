<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Audit;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        $sessionId = session()->getId();

        Audit::create([
            'user_id'    => $event->user->id,
            'session_id' => $sessionId,
            'login_at'   => now(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
        ]);
    }
}
