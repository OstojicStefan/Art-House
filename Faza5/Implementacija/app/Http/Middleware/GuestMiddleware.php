<?php

namespace App\Http\Middleware;

use App\Models\dimitrije\RegistredModel;
use Closure;
use Illuminate\Http\Request;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->session()->get('IDUser');
        if (($user = RegistredModel::find($userId)) != null) {
            return redirect('testing');
        }
        return $next($request);
    }
}
