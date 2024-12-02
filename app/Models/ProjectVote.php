<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectVote extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'user_id',
        'type',
    ];

}
