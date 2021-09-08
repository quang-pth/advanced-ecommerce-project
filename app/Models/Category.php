<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_name_en',
        'category_name_vn',
        'category_slug_en',
        'category_slug_vn',
        'category_icon',
    ];

    public function subCategory() {
        return $this->hasMany(subCategory::class, 'category_id', 'id');
    }

    public function product() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
