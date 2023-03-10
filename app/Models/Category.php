<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'enable',
    ];

    public function categoryProduct(): HasMany
    {
        return $this->hasMany(CategoryProduct::class);
    }
}
