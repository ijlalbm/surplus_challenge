<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request, $id)
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

        //find post by ID
        $image = Image::find($id);

        //check if image is not empty
        if ($request->hasFile('file')) {

            //upload image
            $imageFile = $request->file('file');
            $imageFile->storeAs('public/file/', $imageFile->hashName());

            //delete old image
            Storage::delete('public/file/'.$image->file);

            //update image with new image
            $image->update([
                'name'     => $request->name,
                'file'     => $imageFile->hashName(),
                'enable'   => $request->enable,
            ]);

        } else {

            //update image without image
            $image->update([
                'name'     => $request->name,
                'enable'   => $request->enable,
            ]);
        }

        //return response
        return new ImageResource(true, 'Data Image Berhasil Diubah!', $image);
    }

    public function destroy($id)
    {

        //find image by ID
        $image = Image::find($id);

        //delete image
        Storage::delete('public/file/'.$image->file);

        //delete image
        $image->delete();

        //return response
        return new ImageResource(true, 'Data Image Berhasil Dihapus!', null);
    }
}
