<?php

namespace Tests\Feature;

use App\Models\Artifact;
use App\Models\Exhibition;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExhibitionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function admin_can_create_exhibition(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);
        $response = $this->post(route('create-exhibition', [
            'name' => 'test',
            'startDate' => '01-01-2001',
            'endDate' => '01-02-2001'
        ]));

        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function artist_cannot_create_exhibition(): void
    {
        $artist = User::factory()->artist()->create();

        $this->actingAs($artist);
        $response = $this->post(route('create-exhibition', [
            'name' => 'test',
            'startDate' => '01-01-2001',
            'endDate' => '01-02-2001'
        ]));

        $response->assertForbidden();
    }

    /**
     * @test
     */
    public function unauthorized_cannot_create_exhibition(): void
    {
        $response = $this->post(route('create-exhibition', [
            'name' => 'test',
            'startDate' => '01-01-2001',
            'endDate' => '01-02-2001'
        ]));

        $response->assertRedirect();
    }

    /**
     * @test
     */
    public function admin_can_update_exhibitions(): void
    {
        $exhibition = Exhibition::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $response = $this->put(route('update-exhibition', ['exhibition' => $exhibition->id]), [
            'name' => 'test',
            'startDate' => '01-01-2001',
            'endDate' => '01-02-2001'
        ]);
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function artifacts_can_be_added_to_exhibition(): void
    {
        $exhibition = Exhibition::factory()->create();
        $artifact = Artifact::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $response = $this->post(route('add-artifact-to-exhibition', ['exhibition' => $exhibition->id]), [
            'artifactId' => $artifact->id
        ]);
        $response->assertSuccessful();
        $this->assertDatabaseHas('artifact_exhibition', [
            'artifact_id' => $artifact->id,
            'exhibition_id' => $exhibition->id
        ]);
    }

    /**
     * @test
     */
    public function get_exhibitions_works(): void
    {
        $exhibition = Exhibition::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $response = $this->get(route('get-exhibitions'));

        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function get_exhibitions_with_artifacts_works(): void
    {
        $exhibition = Exhibition::factory()->create();
        $artifact = Artifact::factory()->create();
        $exhibition->artifacts()->attach($artifact->id);

        $response = $this->get(route('get-exhibitions-with-artifacts'));

        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function update_exhibition_works(): void
    {
        $exhibition = Exhibition::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $response = $this->put(route('update-exhibition', ['exhibition' => $exhibition->id]), [
            'name' => 'test',
            'startDate' => '01-01-2001',
            'endDate' => '01-02-2001'
        ]);

        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function delete_exhibition_works(): void
    {
        $exhibition = Exhibition::factory()->create();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $response = $this->delete(route('delete-exhibition', ['exhibition' => $exhibition->id]));

        $response->assertSuccessful();
    }
}
