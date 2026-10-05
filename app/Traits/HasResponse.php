<?php

namespace App\Traits;

/**
 * Trait HasResponse
 *
 * Provides standardized API response formatting.
 */
trait HasResponse
{
    /**
     * Return a success response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return array
     */
    protected function successResponse(mixed $data = null, string $message = 'Operation successful', int $statusCode = 200): array
    {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param int $statusCode
     * @param mixed $errors
     * @return array
     */
    protected function errorResponse(string $message = 'An error occurred', int $statusCode = 422, mixed $errors = null): array
    {
        return [
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ];
    }
}