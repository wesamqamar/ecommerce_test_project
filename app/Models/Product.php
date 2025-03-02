<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = "products";

    protected $fillable = ["name", "description", "price", "stock","category_id" ];
    protected $guarded = ['status'];

    public function scopeFilter($query, $term)
{
    return $query->where('name', 'LIKE', '%' . $term . '%');
}
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
{
    return $this->reviews()->avg('rating') ?? 0;
}
}
