<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    public function createResponse($data, $code = Response::HTTP_CREATED)
    {
        return response()->json(['data' => $data], $code);
    }
    public function noResponse($message, $code = Response::HTTP_NO_CONTENT)
    {
        return response()->json(['message' => $message], $code);
    }
}
