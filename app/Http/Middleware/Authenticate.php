<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\URL;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
           // return route('login');

           if($request->routeIs('author.*')){
            session()->flash('fail','Vocé deve logar primeiro');
           return route('author.login', ['falhou'=>true,'retornarUrl'=>URL::current()]);
        }


        }
    }
}
