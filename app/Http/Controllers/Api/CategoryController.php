<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        //get all posts
        $category = Category::latest()->paginate(5);

        //return collection of posts as a resource
        return new CategoryResource(true, 'List of Category', $category);
    }
}
