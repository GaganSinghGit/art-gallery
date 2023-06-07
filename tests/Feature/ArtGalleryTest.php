<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtGalleryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_create_art_gallery(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);
        $response = $this->post(route('create-art-gallery'), [
            'name' => 'Test Art Gallery',
        ]);

        $response->assertSuccessful();
    }
}
