<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    public function equal(Request $request){
        $validated = $request->validate([
            'promocode' => 'required|max:255'
        ]);
        $promocodes = Promocode::get();
        foreach ($promocodes as $promo){
            if($promo->promocode==$validated['promocode']){
                Auth::user()->update(['my_balance'=>Auth::user()->my_balance + $promo->price]);
                return redirect()->route('shops.index')->with('message',__('alerts.your balance increased'));
            }
        }
        return back()->withErrors(__('alerts.it`s not already promocode'));
    }
    public function index()
    {
        $promocodes = Promocode::get();
        return view('promocode.index',['promocodes' => $promocodes]);
    }
 public function equalGet()
    {

        return view('promocode.equal');
    }


    public function create()
    {

        return view('promocode.create');
    }

    public function store(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'promocode' => 'required|max:255',
            'price'  => 'required|numeric'
        ]);
        Promocode::create($validated);
        return redirect()->route('adm.promocode.index')->with('message',__('alerts.Your promocode successfully saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
      Promocode::where('id',$id)->delete();
      return redirect()->route('adm.promocode.index')->with('message',__('alerts.Your promocode successfully Deleted'));
    }
}
