<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 422);
            }
        });

        $this->renderable(function (AuthorizationException $e, Request $request) {
            // AccessDeniedHttpException it doesn't handle AuthorizationException here
            // but do matches Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException instead
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        if (in_array('api', $request->route()->computedMiddleware)) {
            return match(true) {
                $e instanceof AuthorizationException => response()->json(['message' => $e->getMessage()], 403),
                default => parent::render($request, $e),
            };
        }

        return parent::render($request, $e);
    }
}
