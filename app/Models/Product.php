<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'amount', 'category_id', 'state', 'created_at', 'updated_at'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
