<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProjectView extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'project_id',
    ];

}
