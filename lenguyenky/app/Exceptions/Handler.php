<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Ky\Core\Exceptions\BaseException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function render($request, Exception $e)
    {
        $statusCode  = 400;
        $errors      = [];
        $message     = __('messages.errors.unhandled_exception');
        $messageCode = '';

        switch (true) {
            case $e instanceof ValidationException:
                $message    = __('messages.errors.validation_error');
                $errors     = $e->errors();
                $statusCode = 422;
                break;

            case $e instanceof NotFoundHttpException:
            case $e instanceof MethodNotAllowedHttpException:
            case $e instanceof AccessDeniedHttpException:
            case $e instanceof AuthorizationException:
                $message    = __('messages.errors.route_not_found');
                $statusCode = 404;
                $messageCode = 'route.not_found';
                break;

            case $e instanceof ModelNotFoundException:
                $message = __('messages.errors.record_not_found');
                $statusCode = 404;
                $messageCode = 'record.not_found';
                break;

            case $e instanceof AuthenticationException:
                $message = __('messages.errors.session_not_found');
                $statusCode = 401;
                $messageCode = 'session.not_found';
                break;

            case $e instanceof ThrottleRequestsException:
                $message = __('messages.errors.throttle_request');
                $messageCode = 'request.max_attemps';
                break;

            case $e instanceof BaseException:
                $message     = $e->getMessage();
                $messageCode = method_exists($e, 'getMessageCode') ? $e->getMessageCode() : null;
                $statusCode  = $e->getCode();
                break;

            default:
                break;
        }

        return $request->is('api/*')
            ? response()->json([
                'message' => $message,
                'errors'  => $errors,
                'code'    => $messageCode
            ], $statusCode) : response($message, 400);
    }
}
