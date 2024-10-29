<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class AgeCheck
{
    public function handle($request, Closure $next)
    {
        // Ambil birthdate dari request
         $birthdate=$request->user()->birthdate;

        // Pastikan birthdate tidak kosong
        if ($birthdate) {
            $age = Carbon::parse($birthdate)->age;

            // Cek umur
            if ($age < 18) {
                return redirect()->route('welcome')
                    ->withErrors(['error' => 'Anda berusia kurang dari 18 tahun!']);
            }
        }

        return $next($request);
    }
}
