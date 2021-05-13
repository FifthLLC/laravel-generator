<?php

namespace Fifth\Generator\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        $response = call_user_func_array([$this, $method], $parameters);

        if (is_array($response)) $response = $this->successResponse($response);

        return $response;
    }

    public function errorResponse(string $errorMessage = 'Not Found', int $status = 404) : JsonResponse
    {
        return response()->json($errorMessage, $status);
    }

    public function successResponse(array $res, int $status = 200) : JsonResponse
    {
        return response()->json($res, $status);
    }
}
