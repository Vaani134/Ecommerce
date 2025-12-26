<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\Audit;

class LogSuccessfulLogout
{
    public function handle(Logout $event): void
    {
        $sessionId = session()->getId();

        Audit::where('user_id', $event->user->id ?? null)
            ->where('session_id', $sessionId)
            ->whereNull('logout_at')
            ->latest('login_at')
            ->limit(1)
            ->update(['logout_at' => now()]);
    }
}
