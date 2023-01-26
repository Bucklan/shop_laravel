@extends('layouts.app')
@section('title','index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-success" href="{{route('shops.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                    </svg></a>
                <form action="{{route('shops.update',$shop->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.Title') }}</label>
                        <input type="text" value="{{$shop->title}}" class="form-control @error('title') is-invalid @enderror" id="titleInput"
                               name="title"
                               placeholder="Enter title">
                        @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Сипаттама</label>
                        <input type="text" value="{{$shop->content_kz }}" class="form-control @error('content_kz') is-invalid @enderror"
                               id="titleInput"
                               name="content_kz"
                               placeholder="Сипаттама">
                        @error('content_kz')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Описания</label>
                        <input type="text" value="{{$shop->content_ru }}" class="form-control @error('content_ru') is-invalid @enderror"
                               id="titleInput"
                               name="content_ru"
                               placeholder="Описания">
                        @error('content_ru')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Content</label>
                        <input value="{{$shop->content_en }}" type="text" class="form-control @error('content_en') is-invalid @enderror"
                               id="titleInput"
                               name="content_en"
                               placeholder="Content">
                        @error('content_en')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group py-4">
                        <img src="{{asset($shop->image)}}" width="100" height="100" alt="">
                    </div>
                    <div class="form-group mt-4">
                        <label for="imgInput" class="form-label">{{ __('edits.photo') }}</label>
                        <input type="file" value="{{$shop->image}}" class="form-control @error('image') is-invalid @enderror" id="imgInput"
                               name="image">
                        @error('image')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="priceInput">{{ __('messages.Price') }}</label>
                        <input type="number" value="{{$shop->price}}" class="form-control @error('price') is-invalid @enderror" id="priceInput"
                               name="price" placeholder={{ __('messages.enter price') }}>
                        @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoryInput">{{ __('messages.Category') }}</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach($categories as $cat)
                                <option @if($cat->id==$shop->category_id) selected @endif value="{{$cat->id}}">{{$cat->{'name_'.app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>


                    <div>
                        <button class="btn btn-outline-success mt-3" type="submit">{{__('buttons.send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
