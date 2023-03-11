<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        //get all product
        $product = Product::latest()->paginate(5);
        return new ProductResource(true, 'List of Product', $product);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'description'       => 'required',
            'enable'            => 'required|boolean',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create product
        $product = Product::create([
            'name'              => $request->name,
            'description'       => $request->description,
            'enable'            => $request->enable,
        ]);

        //return response
        return new ProductResource(true, 'Data Product Berhasil Ditambahkan!', $product);
    }
}
