<?php

namespace App\Http\Middleware;

use App\Models\dimitrije\ModeratorModel;
use App\Models\dimitrije\AdministratorModel;
use App\Models\dimitrije\RegistredModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ModeratorMiddleware
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
        if ((Session::get('privilegije') != 'Administrator') && (Session::get('privilegije') != 'Moderator')) {
            return redirect('/');
        }
        if(RegistredModel::find($userId)['IsBanned'] == 1){
            //auth()->logout();
            $request->session()->flush();
            return redirect()->route('login')
                ->withError('Your account has been banned');
        }
        return $next($request);
    }
}
