<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];
    public function user() : BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'project_categories', 'project_id', 'category_id');
    }

    public function image_urls() : HasMany {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }
    public function comments() : HasMany {
        return $this->hasMany(Comment::class, 'project_id', 'id');
    }
    public function votes() : BelongsToMany {
        return $this->belongsToMany(User::class, 'project_votes', 'project_id', 'user_id')->withPivot('type');
    }

    public function project_views()
    {
        return $this->belongsToMany(User::class, 'project_views', 'project_id', 'user_id');
    }

    public function user_likes() : BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'user_likes',
            'project_id',
            'user_id',
        );
    }
}
