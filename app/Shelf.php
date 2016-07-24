<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Shelf extends Model
{
    use AlgoliaEloquentTrait;

    public static $perEnvironment = true;

    protected $table = 'shelves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'cover'
    ];

    /**
     * Get the user that created the Shelf.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the books that belong to this shelf.
     */
    public function books()
    {
        return $this->belongsToMany('App\Book')->withTimestamps();
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getShelfUrl()
    {
        return '/@' . $this->user()->username . '/shelves/' . $this->slug;
    }

    public function getAlgoliaRecord()
    {
        /**
         * Load the user relation so that it's available
         *  in the laravel toArray method
         */
        $this->user;

       return $this->toArray();
    }
}
