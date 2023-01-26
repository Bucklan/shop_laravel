@extends('layouts.app')
@section('title','INDEX PAGE')
@section('content')
    <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                                <div class="row g-0">
                                    @isset($shopsInCart)
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <h1 class="fw-bold mb-0 text-black">{{__('cart.Shopping Cart')}}</h1>
                                                <h6 class="mb-0 text-muted">{{count($shopsInCart)}} {{__('cart.products')}}</h6>
                                            </div>
                                            <hr class="my-4">
                                            @foreach($shopsInCart as $shop)
                                                <tr>

                                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                            <img src="{{$shop->image}}" class="card-img-top" alt="..."
                                                                 width="150" height="100">
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="text-black mb-0">{{$shop->title}}</h6>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2 col-xl-2 ">
                                                            <form action="{{route('cart.puttocart',$shop->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <button class="increase btn btn-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                         height="16" fill="currentColor"
                                                                         class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd"
                                                                              d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                            <form action="{{route('cart.removecart',$shop->id)}}" method="post">
                                                                @csrf
                                                                <button class="increase btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                                                    </svg>
                                                                </button>
                                                            </form>

{{--                                                                                                                    <form action="{{route('cart.removecart',$shop->id)}}" method="post">--}}
{{--                                                                                                                        @csrf--}}
{{--                                                                                                                        <button class="decrease btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">--}}
{{--                                                                                                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>--}}
{{--                                                                                                                            </svg></button>--}}
{{--                                                                                                                    </form>--}}
                                                        </div>

                                                        <div class="col-md-2 col-lg-2 col-xl-2 ">
                                                            <h6 class="text-black mb-0">{{$shop->{'content_'.app()->getLocale()} }}</h6>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="mb-0">{{$shop->pivot->number}}x {{$shop->price}}
                                                                KZT</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <form action="{{route('cart.deletefromcart',$shop->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <button class="btn btn-danger"
                                                                        type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                                    </svg>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>

                                                </tr>
                                            @endforeach
                                            <hr class="my-4">

                                            <div class="pt-5">
                                                <h6 class="mb-0"><a href="{{route('shops.index')}}" class="text-body"><i
                                                            class="btn btn-secondary-soft"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
                                                            <path d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5z"/>
                                                        </svg></a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 bg-grey">
                                        <div class="p-5">
                                            <h3 class="fw-bold mb-5 mt-2 pt-1">{{__('cart.Summary')}}</h3>
                                          @foreach($shopsInCart as $shop)
                                            {{$shop->title}} ----------- {{$shop->pivot->number*$shop->price}} KZT ({{$shop->pivot->number}}x {{$shop->price}} KZT)
                                              <br>
                                            @endforeach
                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-5">
                                                <h5 class="text-uppercase">{{__('cart.Total price')}}</h5>
                                                <h5>{{$total}} KZT</h5>
                                            </div>
                                            <form action="{{route('cart.buy')}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary">{{__('buttons.Buy all')}}</button>
                                            </form>
                                            <form action="{{route('cart.deleteallcart')}}" method="post">
                                                @csrf
                                                <button class="btn btn-secondary">{{__('buttons.Clear All')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                        <div class="col-lg-12 text-center">
                                            <div class="p-5 ">
                                                <div class="mb-5">
                                                    <h1 class="fw-bold mb-0 text-black">{{__('cart.Your cart is empty')}}</h1>
                                                </div>
                                    @endisset
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



