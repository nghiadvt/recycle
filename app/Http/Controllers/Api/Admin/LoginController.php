<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\Admin\LoginService;
use App\Traits\ResponseTrait;

class LoginController extends Controller
{
    use ResponseTrait;

    protected LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Method login
     *
     * @param LoginRequest $request
     *
     * @return object
     */
    public function login(LoginRequest $request): object
    {
        $data = $request->validated();

        // Call method login form loginService
        $user = $this->loginService->login($data);
        if ($user) {
            return $this->responseSuccess(
                __('string.response.login.success'),
                $user
            );
        }
        return $this->responseError(
            __('string.response.login.fail'),
            null,
            401
        );
    }

    /**
     * Method logout admin
     *
     * @return object
     */
    public function logout(): object
    {
        try {
            auth()->logout();

            return $this->responseSuccess(
                __('string.response.logout.success'),
            );
        } catch (Exception $e) {
            \Log::error($e);

            return $this->responseError(
                __('string.response.logout.fail'),
            );
        }
    }
}
