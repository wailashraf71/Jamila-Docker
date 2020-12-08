<?php

namespace App\Exceptions;

use App\Http\Resources\ResponseResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($request->wantsJson()) {   //add Accept: application/json in request
                return $this->handleApiException($request, $exception);
            }
            else {
                return response()->json([
                    "success" => false,
                    "message" => 'Not Found',
                    "errors" => $exception->getMessage()
                ]);
            }
        }
        else {
            if ($exception instanceof NotFoundHttpException) {
                return Route::respondWithRoute('fallback');
            }
            if ($exception instanceof ModelNotFoundException) {
                return Route::respondWithRoute('fallback');
            }
        }
        return parent::render($request, $exception);
    }
}
