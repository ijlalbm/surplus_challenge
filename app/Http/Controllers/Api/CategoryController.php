<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        //get all category
        $category = Category::latest()->paginate(5);
        return new CategoryResource(true, 'List of Category', $category);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'enable'   => 'required|boolean',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create category
        $category = Category::create([
            'name'     => $request->name,
            'enable'   => $request->enable,
        ]);

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Ditambahkan!', $category);
    }

    public function show($id)
    {
        //find category by ID
        $category = Category::find($id);

        //return single category as a resource
        return new CategoryResource(true, 'Detail Data Category', $category);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'enable'   => 'required|boolean',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find category by ID
        $category = Category::find($id);

        $category->update([
            'name'     => $request->name,
            'enable'   => $request->enable,
        ]);

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    public function destroy($id)
    {

        //find category by ID
        $category = Category::find($id);

        //delete category
        $category->delete();

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Dihapus!', null);
    }
}
