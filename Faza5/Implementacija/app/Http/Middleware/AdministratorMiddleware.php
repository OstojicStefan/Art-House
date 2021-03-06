<?php
//Dimitrije Plavsic 18/220
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\dimitrije\AdministratorModel;

//middleware za stranice kojima samo admin moze pristupiti
class AdministratorMiddleware
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
        if (AdministratorModel::find($userId) == null) {
            return redirect('/');
        }
        return $next($request);
    }
}
