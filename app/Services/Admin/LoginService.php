<?php

namespace App\Services\Admin;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function login($data)
    {
        if (!$token = auth::attempt($data)) {
            return false;
        }
        return $this->customResponeUser($token);
    }

    public function logout()
    {
        auth()->logout();
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    public function customResponeUser($token)
    {
        $user = auth()->user();
        return  [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'email_login' => $user->email_login,
            'type' => $user->login_type,
            'created_at' => $user->created_at,
            'access_token' => $token,
            'token_type' => 'bearer',
        ];
    }
}
