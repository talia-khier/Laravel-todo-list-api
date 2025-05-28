<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $levels = [
        // Add log levels for exception types if needed
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Custom logging can go here
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'status' => 'error',
                'message' => 'HTTP method not allowed for this route.'
            ], 405);
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.'
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
