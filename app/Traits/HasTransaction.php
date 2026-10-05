<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Trait HasTransaction
 *
 * Provides database transaction support for services and repositories.
 */
trait HasTransaction
{
    /**
     * Execute a callback within a database transaction.
     *
     * @param callable $callback
     * @param int $attempts
     * @return mixed
     *
     * @throws \Throwable
     */
    protected function executeTransaction(callable $callback, int $attempts = 1): mixed
    {
        return \DB::transaction($callback, $attempts);
    }
}