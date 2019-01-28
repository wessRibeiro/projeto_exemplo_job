<?php

namespace Convenia\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class Handler
 * @package Convenia\Exceptions
 */
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // Not found exception handler
        if($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => [
                    'description' => 'Invalid URI',
                    'messages' => []
                ]
            ], 404);
        }

        // Method not allowed exception handler
        if($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => [
                    'description' => 'Method Not Allowed',
                    'messages' => []
                ]
            ], 405);
        }

        if ($exception instanceof ModelNotFoundException &&
            $request->wantsJson())
        {
            return response()->json([
                'error' => 'Resource not found',
                'code'  => 404
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
