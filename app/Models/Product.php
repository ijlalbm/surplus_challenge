<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'enable',
    ];

    public function categoryProduct(): HasOne
    {
        return $this->hasOne(CategoryProduct::class);
    }

    public function productImage(): HasOne
    {
        return $this->hasOne(ProductImage::class);
    }
}
