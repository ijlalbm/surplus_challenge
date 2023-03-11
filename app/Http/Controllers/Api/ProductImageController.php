<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Image;
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

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'product_id'           => 'required',
            'image_id'             => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find product_id by ID
        $product_id = Product::find($request->product_id);

        //find product_id by ID
        $image_id = Image::find($request->image_id);

        if ($product_id != null) {
            if ($image_id != null) {
                //create categoryProduct
                $categoryProduct = ProductImage::create([
                    'product_id'     => $request->product_id,
                    'image_id'    => $request->image_id,
                ]);
            } else {
                return response()->json(["success" => false, "message" => "image_id tidak terdaftar"], 400);
            }
        } else {
            return response()->json(["success" => false, "message" => "product_id tidak terdaftar"], 400);
        }
        //return response
        return new ProductImageResource(true, 'Product Image berhasil dibuat', $categoryProduct);
    }

    public function show($id)
    {
        //find categoryProduct by ID
        $productImage = ProductImage::where('product_id', $id)->get();

        //return single categoryProduct as a resource
        return new ProductImageResource(true, 'Detail produk image', $productImage);
    }
}
