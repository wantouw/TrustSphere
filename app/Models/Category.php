<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public function projects() : BelongsToMany {
        return $this->belongsToMany(
            Project::class,
            'project_categories',
            'category_id',
            'project_id',
        );
    }
}
