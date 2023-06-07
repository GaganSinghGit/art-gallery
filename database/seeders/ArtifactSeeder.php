<?php

namespace Database\Seeders;

use App\Models\Artifact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtifactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artifact::factory(10)->create();
    }
}
