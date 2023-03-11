<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;
use App\Http\Resources\ProductImageResource;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    public function index()
    {
        //get all categoryProduct
        $productImage = ProductImage::latest()->paginate(5);
        return new ProductImageResource(true, 'List of Product Image', $productImage);
    }
}
