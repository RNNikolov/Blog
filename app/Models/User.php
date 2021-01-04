<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * The role that belong to the user.
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
            ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
            ->withTimestamps();
    }

    public function follow($userId)
    {
        $this->follows()->attach($userId);
        return $this;
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    public function isFollowing($userId)
    {
        return (boolean)$this->follows()->where('follows_id', $userId)->first(["users.id"]);
    }

    public function hasRole($role)
    {
        if ($this->role->name == $role) {
            return true;
        }

        return false;
    }
}
