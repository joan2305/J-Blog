<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class blogController extends Controller
{
    public function index(){
        $categories = Category::all();
        $blogs = (Auth::user()->role=='Admin')? $blogs = Blog::all():$blogs = Blog::where('user_id', Auth::user()->id)->get();
        
        // if(Auth::user()->role=='Admin'){
        //     $blogs = Blog::all();
        // }else{
        //     $blogs = Blog::where('user_id', Auth::user()->id)->get();
        // }
        
        return view('blog.index', compact('categories'), compact('blogs'));

        // return view('blog.index', [
        //     'categories' => $categories
        // ]);
    }
    
    public function store(Request $request){
        // Validation

        $request->validate([
            'cover' => 'required',
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string',
            'content' => 'required|min:3|string',
            'category' => 'required|numeric',
        ]);

        // FILE PROCESSING
        $file = $request->file('cover');
        $fullFileName = $file->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $file->getClientOriginalExtension();
        $coverName = $fileName . '-'. Str::random(10) . '-'. date('YmdHis').'.' . $extension;
        $file ->storeAs('public/images/cover', $coverName);  

        // STORE TO DATABASE
        Blog::create([
            'cover' => $coverName,
            'title' =>  $request->title,
            'description' =>  $request->description,
            'content' =>  $request->content,
            'status' =>  'Pending',
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);

        return redirect('/blog') -> with('pesan_sukses', 'Blog Successfully Created!');
    }
    public function edit($id){
        $categories = Category::all();
        $blog = Blog::find($id);
        if($blog->user_id != Auth::user()->id){
            abort(404);
        }else{
            return view('blog.edit', compact('blog'), compact('categories'));       
        }
    }
    public function update(Request $request, $id){
        $blog = Blog::find($id);
        if($blog->user_id != Auth::user()->id){
            abort(404);
        }
        else{
            if($request->file('cover')==null){
                $request->validate([
                    'title' => 'required|min:3|string',
                    'description' => 'required|min:3|string',
                    'content' => 'required|min:3|string',
                    'category' => 'required|numeric',
                ]);
                $blog->update([
                    'title' =>  $request->title,
                    'description' =>  $request->description,
                    'content' =>  $request->content,
                    'status' =>  'Pending',
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category
                ]);
            }
    
            else{
                $request->validate([
                    'cover' => 'required',
                    'title' => 'required|min:3|string',
                    'description' => 'required|min:3|string',
                    'content' => 'required|min:3|string',
                    'category' => 'required|numeric',
                ]);
        
                // FILE PROCESSING
                $file = $request->file('cover');
                $fullFileName = $file->getClientOriginalName();
                $fileName = pathinfo($fullFileName)['filename'];
                $extension = $file->getClientOriginalExtension();
                $coverName = $fileName . '-'. Str::random(10) . '-'. date('YmdHis').'.' . $extension;
                $file ->storeAs('public/images/cover', $coverName);  
        
                if(Storage::exists('public/images/cover/' . $blog->cover)){
                    Storage::delete('public/images/cover/' . $blog->cover);
                }
                // STORE TO DATABASE
                $blog->update([
                    'cover' => $coverName,
                    'title' =>  $request->title,
                    'description' =>  $request->description,
                    'content' =>  $request->content,
                    'status' =>  'Pending',
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category
                ]);
            }
            return redirect('/blog') -> with('pesan_sukses', 'Blog Successfully Edited!');
        }
    }
    public function acceptBlog($id){
        $blog = Blog::find($id);
        // $blog = Blog::where('id', $id)->update([
        //     'status'=>'Accepted'
        // ]); --> ini bisa tanpa ngasih fillable 'status' di model, dia ini query builder
        // kalo Blog::find itu eloquent
        $blog->update([
           'status' => 'Accepted' 
        ]);
        return redirect('/blog') -> with('pesan_sukses', 'Blog Accepted!');
    }

    public function search(Request $request){
        $searchResult = Blog::where('title', 'like', '%' . $request->searchInput . '%')->where('status', 'Accepted')->get();
        return view('blog.result', ['blogs' => $searchResult]);
    }
    public function destroy($id){
        $blog = Blog::find($id);
        // DELETE IMAGE LOCAL
        if($blog->user_id != Auth::user()->id){
            abort(404);
        }else{
            if(Storage::exists('public/images/cover/' . $blog->cover)){
                Storage::delete('public/images/cover/' . $blog->cover);
            }
    
            // DELETE FROM DATABASE
            $blog->delete();
            return redirect('/blog') -> with('pesan_sukses', 'Blog Successfully Deleted!');
        }
    }
}