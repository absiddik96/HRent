<?php

namespace App\Traits;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Passport\Exceptions\MissingScopeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($e instanceof RequestException) {
            return $this->return_error('Bad Request',Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof NotFoundHttpException){
            return $this->return_error('Page Not Found',Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ModelNotFoundException){
            return $this->return_error('Page Not Found',Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof MissingScopeException){
            return $this->return_error('Unauthenticated',Response::HTTP_FORBIDDEN);
        }

        return parent::render($request, $e);
    }

    protected function return_error($message,$status){
        return response()->json(['errors' => [
            'message' => $message,
            'status' => $status,
        ]], $status);
    }
}
