<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json([ 'data' => $data ], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse($instance, $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return response()->json(['message' => $message, 'code' => $code]);
    }

    protected function responseUploadFile($data, $code)
    {
        return response()->json(['data' => $data, 'code' => $code]);
    }

}
