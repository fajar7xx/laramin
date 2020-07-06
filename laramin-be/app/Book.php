<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'slug',
        'description',
        'author',
        'publisher',
        'cover',
        'price',
        'weight',
        'views',
        'stocks',
        'status'
    ];
}
