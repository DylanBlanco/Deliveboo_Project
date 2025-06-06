<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

// INTERCETTA ERRORE DIMENSIONE IMMAGINE
use Illuminate\Http\Exceptions\PostTooLargeException;

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
    }


    // INTERCETTA ERRORE DIMENSIONE IMMAGINE
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof PostTooLargeException) {
            return response()->json([
                'message' => 'Il file caricato è troppo grande. Per favore, riprova con un file più piccolo.'
            ], 413);
        }
    
        return parent::render($request, $exception);
    }
};
