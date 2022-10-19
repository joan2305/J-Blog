<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class APIController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return response()->json([
           'status' => true,
            'blogs' => $blogs 
        ]);
    }

    public function show($id){
        $blogs = Blog::findOrFail($id);
        return response()->json([
           'status' => true,
            'blogs' => $blogs 
        ]);
    }
}