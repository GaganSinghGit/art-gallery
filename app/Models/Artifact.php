<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artifact extends Model
{
    use HasFactory;

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function exhibitions(): BelongsToMany
    {
        return $this->belongsToMany(Exhibition::class);
    }
}
