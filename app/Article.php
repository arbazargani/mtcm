<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'title',
        'slug',
        'author',
        'hidden',
        'views',
        'comments',
        'likes',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsToMany('App\Category');
    }
    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function comment() {
        return $this->hasMany('App\Comment');
    }
}
