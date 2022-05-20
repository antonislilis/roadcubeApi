<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    //HTTP status constants
    const HTTP_OK = 200;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_CREATED = 201;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FOUND = 302;

    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_DELETE = 'DELETE';
}
