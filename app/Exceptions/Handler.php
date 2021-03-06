<?php

namespace App\Exceptions;

use App\Core\Returns;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Core\Helpers;

class Handler extends ExceptionHandler
{
    private $sentryID;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if((env('APP_ENV') === 'heroku' || env('APP_ENV') === 'prod')){
            $sentry_id = app('sentryerror')->captureException($exception);
            if ($this->shouldReport($exception)) {
                $this->sentryID = $sentry_id;
            }
        }
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
        if ((env('APP_ENV') === 'heroku' || env('APP_ENV') === 'prod')
            && !Helpers::isApiCall($request) && $this->shouldReport($exception)) {
            return response()->view('errors.500', [
                'sentryID' => $this->sentryID,
            ], 500);
        } else if (Helpers::isApiCall($request)) {
            return response()->json(Returns::forbidden($exception->getMessage()));
        } else {
            return parent::render($request, $exception);
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
