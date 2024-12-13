<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'role_id',
        'dob',
        'profile_picture',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }
    public function project_votes(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_votes', 'user_id', 'project_id')->withPivot('type');
    }
    public function project_views(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_views',
            'user_id',
            'project_id',
        );
    }
    public function liked_projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'user_likes',
            'user_id',
            'project_id',
        );
    }

    public function comment(): HasOne
    {
        return $this->hasOne(Comment::class, 'sender_id', 'id');
    }

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'friends',
            'user_id',
            'friend_id',
        );
    }
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function hasRole($roleName)
{
    return $this->role && $this->role->name === $roleName;
}
}
