<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_user()
    {
        $response = $this->post('/register', [
            'first_name' => 'Doe',
            'last_name' => 'John',
            'email' => 'johndoe@example.com',
            'password' => 'passWord@2',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
        ]);
    }

    /** @test */
    public function it_can_get_all_users()
    {
        $this->withoutMiddleware();
        $user = User::factory()->count(3)->create();
        $response = $this->get('/dashboard');
        $response->assertStatus(200)
            ->assertViewHas('user', $user);
    }


    /** @test */
    public function it_can_update_a_user()
    {
        // $user = User::factory()->create();
        // $role=Role::pluck('name')->first();
        // $data = [
        //     'first_name' => 'Jane',
        //     'email' => 'janedoe@example.com',
        //     'role' => $role,
        // ];
        // $user = $user->id;
        // $response = $this->put('/update/' . $user, $data);

        // $response->assertStatus(200);
        // // ->assertJson(['data' => $data]);

        // $this->assertDatabaseHas('users', $data);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $this->withoutMiddleware();
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $user = $user->id;
        $response = $this->delete('/delete/' . $user);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', ['id' => $user]);
    }
}
