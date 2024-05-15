<?php

namespace App\Http\Middleware;

use Closure;

class RemovePageOneParameter
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah parameter "page" ada dan bernilai 1
        if ($request->query('page') === '1') {
            // Buat URL tanpa parameter "page"
            $urlTanpaPage = $request->url();
            // Hapus parameter "page=1"
            $urlTanpaPage = preg_replace('/[&?]page=1/', '', $urlTanpaPage);

            // Redirect ke URL baru tanpa parameter "page"
            return redirect($urlTanpaPage, 301); // Redirect permanen (optional)
        }

        return $next($request);
    }
}
