<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index()
    {
        //get all image
        $image = Image::latest()->paginate(5);
        return new ImageResource(true, 'List of Image', $image);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'file'              => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'enable'            => 'required|boolean',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('file');
        $image->storeAs('public/file', $image->hashName());

        //create post
        $image = Image::create([
            'file'     => $image->hashName(),
            'name'     => $request->name,
            'enable'   => $request->enable,
        ]);

        //return response
        return new ImageResource(true, 'Data Image Berhasil Ditambahkan', $image);
    }

    public function show($id)
    {
        //find image by ID
        $image = Image::find($id);

        //return single image as a resource
        return new ImageResource(true, 'Detail Data Image', $image);
    }
}
