<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)//index
    {
        //
    }


    public function view(User $user, Shop $shop)//show
    {
        //
    }

    public function create(User $user)//showга журеди
    {
        return ($user->role->name=='moderator');
    }


    public function update(User $user, Shop $shop)
    {
        return ($user->id==$shop->user_id) ||($user->role->name=='admin');    }


    public function delete(User $user, Shop $shop)
    {
        return ($user->id==$shop->user_id) ||($user->role->name=='admin');
    }

    public function restore(User $user, Shop $shop)
    {
        //
    }


    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
