<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      // check login time out
      if(session('login_time') && session('ExpiresIn')) {
          $time = time() - session('login_time');
           if($time > session('ExpiresIn')){
              session()->forget('optimizeit');
           }
      }
      // check is logged in.
      if(session('optimizeit')){
          return $next($request);
      }
      if($request->ajax())
      {
          return response('force_redirect');
      }
      return redirect('/');
    }
}
