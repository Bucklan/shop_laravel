<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categories(){
        return view('shops.categories',['categories'=>Category::all()]);
    }
    public function index(){
            $categories = Category::get();
        return view('adm.categories',['categories'=>$categories]);
    }

    public function create()
    {
        return view('adm.createcategory');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name_kz' => 'required|max:255',
            'name_ru' => 'required|max:255',
            'name_en' => 'required|max:255',
            'image' => 'required|image|max:2048',
        ]);
        $fileName = time() . $request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('categories', $fileName, 'public');
        $validated['image'] = 'storage/' . $image_path;
        Category::create($validated);
        return redirect()->route('adm.categories.index')->with('message', __('alerts.category successfully saved'));
    }

    public function edit(Category $category){
        return view('adm.editcategory',['category'=>$category]);
    }

    public function update(Request $request,Category $category){
        $validated = $request->validate([
            'name_kz' => 'required|max:255',
            'name_ru' => 'required|max:255',
            'name_en' => 'required|max:255',
            'image' => 'required|image|max:2048',
        ]);
        $fileName = time() . $request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('categories', $fileName, 'public');
        $validated['image'] = 'storage/' . $image_path;
        $category->update($validated);
        return redirect()->route('adm.categories.index')->with('message', __('alerts.category successfully changed'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('adm.categories.index')->with('message', __('alerts.category successfully deleted'));
    }
}
