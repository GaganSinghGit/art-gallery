<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exhibition extends Model
{
    use HasFactory;

    public function artifacts(): BelongsToMany
    {
        return $this->belongsToMany(Artifact::class);
    }
}
