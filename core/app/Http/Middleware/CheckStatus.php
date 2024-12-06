<?php

namespace App\Http\Middleware;

use Closure;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
    
 
        if (auth()->guard($guard)->check()) {
            
            $user = auth()->guard($guard)->user();

            if ($user->status && $user->ev && $user->sv && ($guard == 'advertiser' || $user->tv)) {
                return $next($request);
            } else {
                if ($request->is('api/*')) {
                    $notify[] = 'You need to verify your account first.';
                    return response()->json([
                        'remark' => 'unverified',
                        'status' => 'error',
                        'message' => ['error' => $notify],
                        'data' => [
                            'is_ban' => $user->status,
                            'email_verified'  => $user->ev,
                            'mobile_verified' => $user->sv,
                            'twofa_verified'  => $user->tv,
                        ],
                    ]);
                } else {
     
                    return to_route($guard . '.authorization');
                }
            }
        }
        return to_route($guard . '.login');
        // abort(403);
    }
}
