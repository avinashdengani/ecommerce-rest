<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    const AVAILABLE_PRODUCT = 1;
    const UNAVAILABLE_PRODUCT = 2;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',//available //unavailable
        'image',
        'seller_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isAvailable()
    {
        return $this->status == Product::AVAILABLE_PRODUCT;
    }
}
