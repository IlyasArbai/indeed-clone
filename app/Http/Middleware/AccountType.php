<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use LogicException;

class AccountType
{
    public function handle(
        Request $request,
        Closure $next,
        string $type
    ): Response {
        $account = $request->user();

        if (!$account) {
            abort(401);
        }

        try {
            $allowed = true;
            if ($account->role() !== $type) {
                $allowed = false;
            }
        } catch (LogicException $exception) {
            abort(403, 'Account profile is invalid.');
        }

        abort_unless($allowed, 403);

        return $next($request);
    }
}
