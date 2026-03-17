<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ApiSecurityTest extends TestCase
{
    use RefreshDatabase;


    public function test_unauthenticated_user_cannot_access_global_stats(): void
    {
        $response = $this->getJson('/api/stats/global');

         $response->assertStatus(401);
    }
    public function test_login_requires_email_and_password(): void
    {
       $user = User::factory()->create([
            'email' => 'test@cuisine.com',
            'password' => bcrypt('password123'),
        ]);

   $response = $this->postJson('/api/login', [
            'email' => 'test@cuisine.com',
            'password' => 'wrongpass'
        ]);
         $response->assertStatus(401);
    }



}
