<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class CheckRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Schema::hasTable('redirects')) {
            $path = $request->getPathInfo();
            $redirect = Redirect::where('old_url', $path)
                ->where('is_active', true)
                ->first();

            if ($redirect) {
                return redirect($redirect->new_url, $redirect->status_code);
            }
        }

        return $next($request);
    }
}
