<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LogTest extends TestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->signInAsAdmin();
        $this->signInAsUser();
    }

    public function testLogIsCreatedAfterStoreSearchRequest()
    {
        $appName = 'Roadcube';
        $this->json('GET', route('store.search'), ['app_name' => $appName]);

        $response = $this->json('GET',
            $this->setRouteWithTokenAdmin(route('logs.show'))
        );
        $lastElement = $response->json()[count($response->json()) - 1];
        $this->assertContains(request()->getSchemeAndHttpHost() . '/api/store/search', $lastElement);
        $response->assertStatus(200);
    }

    public function testLogIsRequestNotExecutedIfNotLoggedIn()
    {
        $this->json('GET',
            route('logs.show')
        )->assertStatus(401);

    }

    public function testLogIsRequestNotExecutedIfIsSimpleUser()
    {
        $this->json('GET',
            $this->setRouteWithTokenUser(route('logs.show'))
        )->assertStatus(401);

    }

    public function testLogIsRequestExecutedIfAdmin()
    {
        $this->json('GET',
            $this->setRouteWithTokenAdmin(route('logs.show'))
        )->assertStatus(200);

    }
}
