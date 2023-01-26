@extends('layouts.adm')
@section('title','Cart page')
@section('content')
    <h1> {{ __('messages.Cart page') }} </h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('cart.User Name') }}</th>
            <th scope="col">{{ __('cart.Name Product') }}</th>
            <th scope="col">{{ __('cart.Quantity') }}</th>
            <th scope="col">{{ __('cart.Total price') }}</th>
            <th scope="col">{{ __('cart.Confirm') }}</th>

        </tr>
        </thead>
        <tbody>
        @for($i=0;$i<count($shopsInCart);$i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$shopsInCart[$i]->shop->user->name}}</td>
                <td>{{$shopsInCart[$i]->shop->title}}</td>

                <td>{{$shopsInCart[$i]->number}}</td>
                <td>{{$shopsInCart[$i]->number*$shopsInCart[$i]->shop->price}} KZT</td>
                <td><form action="{{route('adm.cart.confirm',$shopsInCart[$i]->id)}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">{{__('cart.Confirm')}}</button>
                    </form>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>

@endsection
