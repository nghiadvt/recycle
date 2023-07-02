<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ResponseTrait
{
    public function response($message, $data, $status)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ], $status);
    }

    /**
     * return to [object] responeSuccess
     *
     * @param [object] $data
     * @param [string] $message
     * @param [integer] $status
     * @return object
     */
    public function responseSuccess($message, $data = [], $status = Response::HTTP_OK)
    {
        return $this->response($message, $data, $status);
    }

    /**
     * return to [object] responeError
     *
     * @param [string] $message
     * @param [integer] $status
     * @return object
     */
    public function responseError($message, $data = [], $status = Response::HTTP_BAD_REQUEST)
    {
        return $this->response($message, $data, $status);
    }
}
