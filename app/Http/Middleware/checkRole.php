<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle($request, Closure $next, ...$roles)
  {
    if (Auth::check()) {
      $user = Auth::user();

      foreach ($roles as $role) {
        if ($user->role === $role) {
          return $next($request);
        }
      }

      return redirect()->back();
    }

    // Lanjutkan jika pengguna tidak login (mengakses frontend)
    return $next($request);
  }
}
