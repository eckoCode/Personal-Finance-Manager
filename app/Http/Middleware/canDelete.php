<?php

namespace App\Http\Middleware;

use App\Account;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class canDelete
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
        $account = Account::findorfail($request->route('account'));

            if (count($account->movements()->get()) == 0 && $account->last_movement_date == null)
            return $next($request);

        return Response::make(view('home'),403);
    }
}
