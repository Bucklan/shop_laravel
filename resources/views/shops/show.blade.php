@extends('layouts.app')
@section('title','index')
@section('content')
    <script src="/js.js"></script>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <img class="card-img-top" src="{{asset($shop->image)}}" height="200" alt="Card image cap"
                 style="width: 200px;height: 150px">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="col-3">
                        <h3 class="card-title">{{$shop->title}}</h3>
                    </div>
                    <div class="col-3">
                        <p class="card-text">{{$shop->{'content_'.app()->getLocale()} }}</p>
                    </div>
                    <div class="col-3"><h5 class="card-text">{{$shop->price}} KZT</h5></div>
                    @can('update', $shop)
                        <a class="btn btn-success mb-2"
                           href="{{route('shops.edit', $shop->id)}}">{{ __('buttons.edit') }}</a>
                    @endcan
                    @can('delete',$shop)
                        <form action="{{route('shops.destroy',$shop->id)}}" method="post">
                            <a> </a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">{{ __('buttons.delete') }}</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-4">
            @if($avg != 0)
                <div class="flex items-center">
                    @for($i=0;$i<$avg;$i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    @endfor
                    @for($i = 5;$i>$avg;$i--)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                            <path
                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    @endfor
                </div>
                <div class="text-xs text-slate-500 ml-1">{{__('buttons.AVG Rating')}}:{{$avg}}+</div>

            @endif
            @auth
                <form action="{{route('shops.rate',$shop->id)}}" method="post">
                    @csrf
                    <select name="rating">
                        @for($i=0;$i<=5;$i++)
                            <option
                                {{ $myRating==$i ? 'selected' : ''}} value="{{$i}}">{{ $i==0 ? __('buttons.Not rated'):$i}}</option>
                        @endfor
                    </select>
                    <button class="btn btn-success">{{__('buttons.send')}}</button>
                </form>
                <form action="{{route('shops.unrate',$shop->id)}}" method="post">
                    @csrf
                    <button class="btn btn-secondary">{{__('buttons.clear')}}</button>
                </form>
            @endauth

            @auth
                <form action="{{route('cart.puttocart', $shop->id)}}" method="post">
                    @csrf
                    <button class="btn btn-primary mt-2">{{ __('buttons.add to cart') }}</button>
                </form>
            @endauth
        </div>
        <div class="col-md-10">
            <div style="margin-top:60px;">
                <form action="{{route('comments.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="commentInput"><h3>{{ __('comments.leave a comment') }}</h3></label>
                        <textarea class="form-control" id="commentInput" name="content"></textarea>
                        <input name="shop_id" value="{{$shop->id}}" type="hidden">
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-success" type="submit">{{ __('buttons.send') }}</button>
                    </div>
                </form>
                <br><br>
                <hr>
            </div>
            <h3 class='text-center'>{{ __('comments.comments') }}</h3>
            @foreach($shop->comments as $comment)
                <div class="card mb-3">
                    <div class="card-header">
                        {{$comment->user->name}} <small>{{$comment->created_at}}</small>
                    </div>
                    <div class="card-body">
                        <h4 class="card-text">{{$comment->content}}</h4>
                        @can('update',$comment)
                            <div class="form-group">
                                <button class="btn btn-success mt-3"
                                        onclick="myFunction()">{{ __('buttons.edit') }}</button>
                            </div>
                            <div id="myDIV" style="display:none;">
                                <form action="{{route('comments.update', $comment->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control mt-3" id="commentInput" name="content"
                                                  rows="3">{{$comment->content}}</textarea>
                                        <input name="shop_id" value="{{$shop->id}}" type="hidden">
                                        @method('PUT')
                                        <button style="float:right;" class="btn btn-success mt-2"
                                                type="submit">{{ __('buttons.save') }}</button>
                                    </div>
                                </form>
                                <form method="post" action="{{route('comments.destroy', $comment->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button style="float:right;margin-right:10px;"
                                            class="btn btn-danger mt-2">{{ __('buttons.delete') }}</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
