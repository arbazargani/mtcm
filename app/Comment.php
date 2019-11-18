<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'family',
        'email',
        'website',
        'content'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
