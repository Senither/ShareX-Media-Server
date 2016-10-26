<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
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
    ];

    /**
     * The route action that was used to trigger the exception.
     *
     * @var null|string
     */
    protected $uses;

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
        if (! starts_with($request->path(), 'cp/')) {
            if (($exception instanceof ModelNotFoundException) || ($exception instanceof NotFoundHttpException)) {
                return $this->loadImageResponse('images/errors/404.jpg', 404);
            }
        }

        return parent::render($request, $exception);
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

        return redirect()->guest('/cp/login');
    }

    /**
     * Gets the route action that was used to trigger the exception.
     *
     * @param  Illuminate\Http\Request $request
     * @return string
     */
    protected function requestUses($request)
    {
        return $this->uses ?: $this->uses = last(explode('\\', $request->route()->getAction()['uses']));
    }

    /**
     * Load the provided image and return it as a http response.
     *
     * @param  string $path
     * @param  int    $statusCode
     * @return Illuminate\Http\Response
     */
    protected function loadImageResponse($path, $statusCode = 200)
    {
        $path = storage_path($path);

        if (! File::exists($path)) {
            return new Response('404 - Not Found!', 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = new Response($file, $statusCode);
        $response->header("Content-Type", $type);

        return $response;
    }
}
