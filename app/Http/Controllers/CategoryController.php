<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();

        // Buat return data ke view, harus pake array ['cth' => $categories], bisa juga pake compact, tapi 
        // namanya jadi sama -> categories => $categories
        // return view('category.index', ['categories' => $categories
        return view('category.index', compact('categories'));
    }

    public function store(Request $request){
        // dump die -> stelah didump, return
        //$request -> buat ngambil title -> pake name yang ada di html
        // VALIDASI
        $request->validate(['title'=> 'required|min:3|string']);
        // STORE TO DATABASE
        Category::create([
            'title' => $request->title
        ]);
        //REDIRECT

        return redirect('/category') -> with('pesan_sukses', 'Category Successfully Created');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }
    public function update(Request $request, $id){
        // VALIDATION
        $request->validate(['title'=> 'required|min:3|string']);
        // UPDATE TO DATABASE
        Category::find($id)->update(['title' => $request->title]);
        return redirect('/category') -> with('pesan_sukses', 'Category Successfully Updated');
    }

    public function destroy($id){
        // dd($id);
        Category::find($id)->delete();
        return redirect('/category') -> with('pesan_sukses', 'Category Successfully Deleted');
    }
}