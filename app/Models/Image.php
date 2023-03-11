<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'file',
        'enable',
    ];

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($file) => asset('/storage/file/' . $file),
        );
    }

    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
