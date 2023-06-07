<?php

namespace Tests\Feature;

use App\Models\Artifact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArtifactsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function get_artifacts_works(): void
    {
        $response = $this->get(route('get-artifacts'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function get_artifacts_returns_artifacts(): void
    {
        $artifacts = Artifact::factory(3)->create();

        $response = $this->get(route('get-artifacts'));

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(3)
                ->first(
                    fn ($json) =>
                    $json->where('name', $artifacts[0]->name)
                        ->where('description', $artifacts[0]->description)
                        ->where('price', $artifacts[0]->price)
                        ->etc()
                )
        );
    }

    /**
     * @test
     * @return void
     */
    public function get_artists_artifacts_works(): void
    {
        $artist = User::factory()->create();
        $artifact = Artifact::factory()->for($artist, 'artist')->create();
        $this->actingAs($artist);
        $response = $this->get(route('my-artifacts'));

        $response->assertStatus(200);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(1)
                ->first(
                    fn ($json) =>
                    $json->where('name', $artifact->name)
                        ->where('description', $artifact->description)
                        ->where('price', $artifact->price)
                        ->where('artist_id', $artist->id)
                        ->etc()
                )
        );
    }

    /**
     * @test
     * @return void
     */
    public function create_artifact_works(): void
    {
        $artist = User::factory()->artist()->create();
        $this->actingAs($artist);

        $response = $this->postJson(route('create-artifact'), [
            'name' => 'Artifact 1',
            'description' => 'Artifact 1 description',
            'price' => 100,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('artifacts', [
            'name' => 'Artifact 1',
            'description' => 'Artifact 1 description',
            'price' => 100,
            'artist_id' => $artist->id,
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function guest_cannot_create_artifact(): void
    {
        $response = $this->postJson(route('create-artifact'), [
            'name' => 'Artifact 1',
            'description' => 'Artifact 1 description',
            'price' => 100,
        ]);

        $response->assertStatus(401);
    }

    /**
     * @test
     * @return void
     */
    public function update_artifact_works(): void
    {
        $artist = User::factory()->artist()->create();
        $artifact = Artifact::factory()->for($artist, 'artist')->create();
        $this->actingAs($artist);

        $response = $this->put(route('update-artifact', ['artifact' => $artifact->id]), [
            'name' => 'Artifact 1',
            'description' => 'Artifact 1 description',
            'price' => 100,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('artifacts', [
            'name' => 'Artifact 1',
            'description' => 'Artifact 1 description',
            'price' => 100,
            'artist_id' => $artist->id,
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function delete_artifact_works(): void
    {
        $artist = User::factory()->artist()->create();
        $artifact = Artifact::factory()->for($artist, 'artist')->create();
        $this->actingAs($artist);

        $response = $this->delete(route('delete-artifact', ['artifact' => $artifact->id]));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('artifacts', [
            'name' => $artifact->name,
            'description' => $artifact->description,
            'price' => $artifact->price,
            'artist_id' => $artist->id,
        ]);
    }
}
