<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'users_id', 'categories_id'
    ];

    public function gallery() {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    
}
