<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\CategoryProductResource;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    public function index()
    {
        //get all categoryProduct
        $categoryProduct = CategoryProduct::latest()->paginate(5);
        return new CategoryProductResource(true, 'List of Category Product', $categoryProduct);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'product_id'              => 'required',
            'category_id'             => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find product_id by ID
        $product_id = Product::find($request->product_id);

        //find product_id by ID
        $category_id = Category::find($request->category_id);

        if ($product_id != null) {
            if ($category_id != null) {
                //create categoryProduct
                $categoryProduct = CategoryProduct::create([
                    'product_id'     => $request->product_id,
                    'category_id'    => $request->category_id,
                ]);
            } else {
                return response()->json(["success" => false, "message" => "category_id tidak terdaftar"], 400);
            }
        } else {
            return response()->json(["success" => false, "message" => "product_id tidak terdaftar"], 400);
        }
        //return response
        return new CategoryProductResource(true, 'Category Product berhasil dibuat', $categoryProduct);
    }

    public function show($id)
    {
        //find categoryProduct by ID
        $categoryProduct = CategoryProduct::where('product_id', $id)->get();

        //return single categoryProduct as a resource
        return new CategoryProductResource(true, 'Detail kategori produk', $categoryProduct);
    }
}
