<?php

namespace Tests\Feature;

use App\Models\User;
use JWTAuth;
use Tests\TestCase;

class LogTest extends TestCase
{
    private $user;
    private $token;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('role_id', '1')->first();
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function testLogIsCreatedAfterStoreSearchRequest()
    {
        $url = route('showLogs') . '?token=' . $this->token;

        $appName = 'Roadcube';
        $this->json('GET', route('searchStores'), ['app_name' => $appName]);

        $response = $this->json('GET', $url);
        $lastElement = $response->json()[count($response->json()) - 1];
        $this->assertContains("http://localhost/api/store/search", $lastElement);
        $response->assertStatus(200);
    }

    public function testLogIsRequestNotExecutedIfNotAdmin()
    {
        $this->json('GET', route('showLogs'))->assertStatus(401);

    }

    public function testLogIsRequestExecutedIfAdmin()
    {
        $url = route('showLogs') . '?token=' . $this->token;

        $this->json('GET', $url)->assertStatus(200);

    }
}
