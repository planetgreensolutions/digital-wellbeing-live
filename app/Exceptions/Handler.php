<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
    public function render($request, Exception $exception){
		
		// pre($exception->getMessage().'>'.$exception->getLine());
		
		if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
			
            return redirect()->to('/page-not-found');
        }
		if($exception instanceof \Illuminate\Auth\AuthenticationException ){
			$response = ['status'=>false,'userMessage'=>'Unauthorized:Invalid token or login'];
			return redirect()->to('/')->with('userMessage', 'Unauthorized:Invalid token or login');
        }
		/* if ($exception instanceof \Symfony\Component\Debug\Exception\FatalThrowableError) { 
			return redirect()->to('/service-not-available');
		} */
		
		if ($exception instanceof MethodNotAllowedHttpException) { 
			// die('Method not allowed');
			// die($exception->getMessage());
            return redirect()->to('/service-not-available');
        }
		/* if(!\Config::get('app.APP_DEBUG')){
			if($exception->getMessage() != 'Unauthenticated.'){
				$text = $exception->getFile().' at line number : '.$exception->getLine().' - '.$exception->getMessage().'.U:'.$request->fullUrl();
				
			}
		}  */
        return parent::render($request, $exception);
    }
}
