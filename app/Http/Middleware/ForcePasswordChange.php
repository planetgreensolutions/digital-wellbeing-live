<?php

namespace App\Http\Middleware;

use Closure;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
		
        // pre('In Force Password Change');
        if(auth()->user()->force_password_change == 1) {
			return redirect()->to(route('admin_change_password'))->with('userMessage','<div class="alert alert-warning">Please change your password to continue.</div>');	
        }
		
        return $next($request);
    }
    
}
