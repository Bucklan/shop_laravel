<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function ShopCat(Category $category)
    {
        $categories = Category::all();
        return view('shops.index', ['shops' => $category->shops, 'categories' => $categories]);


    }

    public function index()
    {
        $allShops = Shop::all();
        $categories = Category::all();
        return view('shops.index', ['shops' => $allShops, 'categories' => $categories]);
    }

    public function create()
    {
        $this->authorize('create', Shop::class);
        return view('shops.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Shop::class);
        $validated = $request->validate([
            'title' => 'required',
            'content_kz' => 'required',
            'content_ru' => 'required',
            'content_en' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
        $fileName = time() . $request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('shops', $fileName, 'public');
        $validated['image'] = 'storage/' . $image_path;
        Auth::user()->shop()->create($validated);
        return redirect()->route('shops.index')->with('message', __('alerts.products saved'));

    }

    public function show(Shop $shop)
    {

        $shop->load('comments.user');
        $myRating = 0;
        if (Auth::check()) {
            $shopRated = Auth::user()->shopsRated()->where('shop_id', $shop->id)->first();
            if ($shopRated) {
                $myRating = $shopRated->pivot->rating;
            }
        }
        $avgRating = 0;
        $sum = 0;

        $ratedUsers = $shop->usersRated()->get();
        foreach ($ratedUsers as $ru) {
            $sum += $ru->pivot->rating;
        }

        if (count($ratedUsers) > 0) {
            $avgRating = $sum / count($ratedUsers);
        }
        if ($avgRating % 1 != 0) {
            $avgRating = $avgRating - $avgRating % 1;;
        }
        return view('shops.show', ['shop' => $shop,
            'categories' => Category::all(),
            'myRating' => $myRating,
            'avg' => $avgRating]);
//        return view('shops.show', ['shop' => $shop]);
    }

    public function edit(Shop $shop, Category $categories)
    {
        $this->authorize('update', $shop);
        $categories = Category::with('shops')->get();
        $shopq = $shop->load('comments.user');
        return view('shops.edit', ['shop' => $shopq, 'categories' => $categories]);
    }


    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content_kz' => 'required',
            'content_ru' => 'required',
            'content_en' => 'required',
            'price' => 'required|numeric',
            'image' => 'image',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
        if ($request->hasFile('image')){
        $fileName = time() . $request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('shops', $fileName, 'public');
        $validated['image'] = 'storage/' . $image_path;
        }
        $shop->update($validated);
        return redirect()->route('shops.index')->with('message', __('alerts.products successfully changed'));
    }


    public function destroy(Shop $shop)
    {
        $this->authorize('delete', $shop);
        $shop->delete();
        return redirect()->route('shops.index')->with('message', __('alerts.products successfully deleted'));
    }

    public function rate(Request $request, Shop $shop)
    {
//        dd($request);
        $validate = $request->validate([
            'rating' => 'required|min:1|max:5'
        ]);
        $shopRated = Auth::user()->shopsRated()->where('shop_id', $shop->id)->first();
        if ($shopRated) {
            Auth::user()->shopsRated()->updateExistingPivot($shop->id, $validate);
        } else {
            Auth::user()->shopsRated()->attach($shop->id, $validate);
//            return back()->with('message', 'Your rating successfully sended');
        }
        return back()->with('message', __('alerts.your assessment is accepted'));
    }

    public
    function unrate(Shop $shop)
    {

        $shopRated = Auth::user()->shopsRated()->where('shop_id', $shop->id)->first();

        if ($shopRated) {
            Auth::user()->shopsRated()->detach($shop->id);
        }
        return back()->with('message', __('alerts.your score has been deleted'));
    }

}
