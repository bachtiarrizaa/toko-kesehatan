<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'stock',
        'price',
        'description',
        'image',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function item() {
        return $this->hasMany(Order_Item::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
