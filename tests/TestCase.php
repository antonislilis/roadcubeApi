<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected User $admin;
    protected string $adminToken;
    protected User $user;
    protected string $userToken;
    const ADMIN_ROLE_ID = '1';
    const USER_ROLE_ID = '2';
    const ROLE_ID_FIELD = 'role_id';

    protected function signInAsAdmin()
    {
        $this->admin = User::where(self::ROLE_ID_FIELD, self::ADMIN_ROLE_ID)->first();
        $this->adminToken = JWTAuth::fromUser($this->admin);
        return $this;
    }

    protected function signInAsUser()
    {
        $this->user = User::where(self::ROLE_ID_FIELD, self::USER_ROLE_ID)->first();
        $this->userToken = JWTAuth::fromUser($this->user);
        return $this;
    }

    protected function setRouteWithTokenAdmin($route)
    {
        return $route . '?token=' . $this->adminToken;
    }
    protected function setRouteWithTokenUser($route)
    {
        return $route . '?token=' . $this->userToken;
    }

}
