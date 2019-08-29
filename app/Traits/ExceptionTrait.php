<?php

namespace App\Traits;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($e instanceof RequestException) {
            return response()->json(['errors' => 'Bad Request'], Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof NotFoundHttpException){
            return response()->json(['errors' => 'Page Not Found'], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ModelNotFoundException){
            return response()->json(['errors' => 'Page Not Found'], Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $e);
    }
}
