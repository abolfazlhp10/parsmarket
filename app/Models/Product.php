<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'user_id',
        'title_fa',
        'title_en',
        'body',
        'price',
        'dis_price',
        'dis_percent',
        'image',
        'brand',
        'gr',
        'seller',
        'options',
        'slug'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function ScopeSearch($query){
        $search=request()->query('q');
        if(!$search){
            return $query;
        }else{
            return $query->where('title_fa','LIKE',"%{$search}%");
        }
    }
}
