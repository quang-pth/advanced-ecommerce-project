<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'subcategory_name_en',
        'subcategory_name_vn',
        'subcategory_slug_en',
        'subcategory_slug_vn',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subSubCategory() {
        return $this->hasMany(subSubCategory::class, 'subcategory_id', 'id');
    }
}
