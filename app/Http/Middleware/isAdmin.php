<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        if (isset($admin)) {
            if (!Auth::guard('admin')->user()->hasPermissionTo('admin_control')) //If user does //not have this permission
            {
                return redirect(route('admin.dashboard'));
            }
        }
        return $next($request);
    }
}
