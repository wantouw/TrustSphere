<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'comment',
        'sender_id',
        'type'
    ];
    public function project() : BelongsTo {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function sender() : BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
