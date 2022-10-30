<?php

namespace App\Http\Middleware;

use Spatie\Permission\Models\Permission;
use Closure;

class AutoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (\App\User::find(auth()->user()->id)->Role->plan == "*") {
            return $next($request);
        } else {
            $perms = $request->route()->getName();
            $plan = \App\User::find(auth()->user()->id)->Role->plan;
            if (!$plan) {
                die('you have not permission');
            }

            $check_perms = in_array($perms, $plan);
            if ($check_perms != true) {
                die('you have not permission');
//                abort(403);
            }
            return $next($request);
        }

        // old

//        $routeName = $request->route()->getName();
//        $permission = Permission::whereRaw("FIND_IN_SET ('$routeName', routes)")->first();
//        if ($permission) {
////            dd($request->user()->can($permission->name));
//            if (!$request->user()->can($permission->name)) {
//                flash()->error(trans('admin.NotPermission'));
//                return redirect()->back();
//            }
//        }
//        return $next($request);
    }
}
