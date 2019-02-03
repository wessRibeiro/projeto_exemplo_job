<?php

namespace Convenia\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exception\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
            return response()->json(
                [
                    'data'    => [],
                    'code'    => 404,
                    'message' => 'Invalid URI'
                ], 404);

        }

        // Not found exception handler
        if($exception instanceof HttpResponseException) {
            return response()->json(
                [
                    'data'    => [],
                    'code'    => 401,
                    'message' => 'Invalid URI'
                ],401);
        }

        // Method not allowed exception handler
        if($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(
                [
                    'data'    => [],
                    'code'    => 405,
                    'message' => 'Method Not Allowed'
                ], 405);
        }

        if ($exception instanceof ModelNotFoundException &&
            $request->wantsJson())
        {
            return response()->json(
                [
                    'data'    => [],
                    'code'    => 404,
                    'message' => 'Resource not found'
                ],404);
        }
        if ($exception instanceof UnauthorizedHttpException &&
            $request->wantsJson())
        {
            return response()->json(
                [
                    'data'    => [],
                    'code'    => 401,
                    'message' => 'Token not provided'
                ],401);
        }

        return parent::render($request, $exception);
    }
}