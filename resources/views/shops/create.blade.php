@extends('layouts.app')
@section('title','index')
@section('content')

    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-9">
                <div>
                    <a href="{{route('shops.index')}} class=btn btn-outline-primary">{{ __('messages.Home') }}</a>
                </div>
                <form action="{{route('shops.store')}}" method="post" ENCTYPE="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.Title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput"
                               name="title"
                               placeholder="Enter title">
                        @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Сипаттама</label>
                        <input type="text" class="form-control @error('content_kz') is-invalid @enderror"
                               id="titleInput"
                               name="content_kz"
                               placeholder="Сипаттама">
                        @error('content_kz')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Описания</label>
                        <input type="text" class="form-control @error('content_ru') is-invalid @enderror"
                               id="titleInput"
                               name="content_ru"
                               placeholder="Описания">
                        @error('content_ru')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Content</label>
                        <input type="text" class="form-control @error('content_en') is-invalid @enderror"
                               id="titleInput"
                               name="content_en"
                               placeholder="Content">
                        @error('content_en')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="imgInput" class="form-label">{{ __('edits.photo') }}</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="imgInput"
                               name="image">
                        @error('image')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="priceInput">{{ __('messages.Price') }}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="priceInput"
                               name="price" placeholder={{ __('messages.Price') }}>
                        @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoryInput">{{ __('messages.Category') }}</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->{'name_'.app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>


                    <div>
                        <button class="btn btn-outline-success mt-3" type="submit">Publish</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

