<?php

namespace Tests\Feature;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\LoginService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_if_login_successfull()
    {
        // $user = User::factory(1)->create();

        $request = new LoginRequest(['email' => 'Ted3@tes.com', 'password' => 'Ted3@tes.com']);

        $loginServiceMock = Mockery::mock(LoginService::class);
        $loginServiceMock->shouldReceive('authenticate')
            ->with($request, 'default')
            ->andReturn('token123');

        $response = $this->post('/login', $request->toArray());
        $response->assertRedirect(route('dashboard'));

        $this->assertEquals('token123', $loginServiceMock->authenticate($request, 'default'));
    }

    public function test_if_login_fails()
    {
        $request = new LoginRequest(['email' => 'Ted3@tes.com', 'password' => 'invalid']);

        $loginServiceMock = Mockery::mock(LoginService::class);
        $loginServiceMock->shouldReceive('authenticate')
            ->with($request, 'default')
            ->andThrow(new AuthenticationException('Invalid credentials'));

        $response = $this->post('/login', $request->toArray());
        $response->assertSessionHasErrors(['password']);

        $loginServiceMock->shouldHaveReceived('authenticate')->with($request, 'default')->once();
    }
}
