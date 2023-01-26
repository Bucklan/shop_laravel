<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Shop;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public  function confirm(Cart $cart){
        $cart->update([
            'status'=>'confirmed'
        ]);
        return back();
    }
    public function cart(){
        $shopsInCart =Cart::where('status','ordered')->with(['shop','user'])->get();
        return view('adm.cart',['shopsInCart'=>$shopsInCart]);
    }
    public function index(Request $request){
        $users =null;
        $roles = Role::all();
        if($request->search){
            $users =User::where('name','LIKE','%'. $request->search.'%')->
            orWhere('email','LIKE','%'.$request->search.'%')->with('role')->get();
        }
        else{
            $users=User::with('role')->get();
        }

        return view('adm.users',['users'=>$users, 'roles' => $roles]);
    }
    public function ban(User $user){
        $user->update([
            'is_active'=>false,
        ]);
        return back()->with('message',__('alerts.user successfully banned'));
    }
    public function unban(User $user){
        $user->update([
            'is_active'=>true,
        ]);
        return back()->with('message',__('alerts.user successfully unbanned'));
    }

    public function edit(User $user)
    {
        return view('adm.users',['user' => $user , 'roles' => Roles::all()]);
    }

    public function update(Request $request, User $user){
        $user->update([
            'id' => $request->id,
            'role_id' => $request->input('role_id'),
        ]);
        return back();
    }
}
