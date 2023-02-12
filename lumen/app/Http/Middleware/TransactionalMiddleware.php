<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TransactionalMiddleware
{
    private int $attempts = 0;
    private int $maxAttempts = 3;

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $this->beginTransaction();
        $response = $next($request);

        if (!empty($response->exception) && $response->exception instanceof QueryException) {
            $this->rollbackTransaction();

            if ($this->isDeadlock($response->exception)) {
                ++$this->attempts;
                if ($this->attempts < $this->maxAttempts) {
                    Log::alert("Transaction retry attempts = $this->attempts");
                    return $this->handle($request, $next);
                }

                Log::error("Transaction rollback after $this->attempts " . $response->exception->getMessage());
            }
        }

        if ($response instanceof Response && $response->getStatusCode() >= 400) {
            $this->rollbackTransaction();
        } else {
            $this->commitTransaction();
        }

        return $response;
    }

    private function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    private function rollbackTransaction(): void
    {
        try {
            DB::rollBack();
        } catch (\Throwable $throwable) {
            // ignore
        }
    }

    private function commitTransaction(): void
    {
        DB::commit();
    }

    private function isDeadlock(\Throwable $throwable): bool
    {
        return Str::contains($throwable->getMessage(), 'try restarting transaction');
    }
}
