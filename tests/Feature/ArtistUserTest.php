<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtistUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function artist_user_can_be_created(): void
    {
        $response = $this->postJson(route('register'), [
            'name' => 'Test Artist',
            'email' => 'test@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_role' => 'artist'
        ]);

        $response->assertSuccessful();
    }
}
