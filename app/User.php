<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'avatar',
        'about',
        'is_onboarded',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fb_token',
        'is_onboarded',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the user's shelves.
     */
    public function shelves()
    {
        return $this->hasMany(Shelf::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get all the topics that this user follows to.
     */
    public function topics()
    {
        return $this->belongsToMany('App\Topic')->withTimestamps();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function isFacebookConnected()
    {
        return $this->facebook_user_id && $this->fb_token;
    }


    /**
     * Get all the likes of the model
     *
     * @return array of likes
     */
    public function likes()
    {
        return Like::with('book', 'book.likes', 'book.authors')->where([
            'user_id' => $this->id,
        ])->get();
    }

    /**
     * Get all liked books of the user.
     *
     * @return Collection of books
     */
    public function allLikedBooks()
    {
        $likes = $this->likes();
        $books = $likes->map(function ($item) {
            return $item->book;
        });

        return $books;
    }

    /**
     * Get all saved books of the user.
     *
     * @return Collection of books
     */
    public function allSavedBooks()
    {
        $allUserShelves = Shelf::with('books')->where([
            'user_id' => $this->id,
        ])->get();
        $savedBooks = $allUserShelves->map(function ($shelf) {
            return $shelf->books;
        });

        return $savedBooks->flatten();
    }

    /**
     * Get the list of users that the current user follows.
     *
     * @return mixed
    */
    public function followedUsers()
    {
        return $this->belongsToMany(static::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * Get the list of users who follow the current user.
     *
     * @return mixed
    */
    public function followers()
    {
        return $this->belongsToMany(static::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * Determine if current user follows another user.
     *
     * @param User $otherUser
     * @return bool
     */
    public function isFollowedBy(User $otherUser)
    {
        $idsWhoOtherUserFollows = $otherUser->followedUsers()->lists('followed_id');

        return in_array($this->id, $idsWhoOtherUserFollows);
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_onboarded' => 'boolean',
    ];
}
