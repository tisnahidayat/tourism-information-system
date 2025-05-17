<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log; // Import facade Log

class RecordVisit
{
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();
        $sessionId = $request->session()->getId();

        $today = Carbon::today()->toDateString();

        $userId = auth()->id();

        $visit = DB::table('visits')
            ->where('ip_address', $ipAddress)
            ->where('session_id', $sessionId)
            ->where('user_id', $userId)
            ->whereDate('date', $today)
            ->first();

        if (!$visit) {
            DB::table('visits')->insert([
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
                'user_id' => $userId,
                'date' => $today,
                'hits' => 1,
                'online' => 1,
                'time' => now()
            ]);
        } elseif ($visit->date != $today) {
            DB::table('visits')
                ->where('id', $visit->id)
                ->update([
                    'hits' => $visit->hits + 1,
                    'date' => $today,
                    'time' => now()
                ]);
        }
        return $next($request);
    }
}
