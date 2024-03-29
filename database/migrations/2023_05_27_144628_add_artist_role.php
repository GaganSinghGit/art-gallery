<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $artist = Role::create(['name' => 'artist']);
        Permission::create(['name' => 'create-artifact']);

        $artist->givePermissionTo('create-artifact');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
