<?php

namespace App\Http\Middleware;
use App\Models\Project;

use Closure;

class UserData
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

        if ($request->project->user_id != auth()->user()->id)
        {
            return response()->view('errors.403');
        }

        return $next($request);
    }
}
