@extends('layouts.adm')

@section('title','Categories page')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <form action="{{route('adm.categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nameInput">Санат</label>
                <input type="text" class="form-control @error('name_kz') is-invalid @enderror" id="nameInput"
                       name="name_kz" value="{{$category->name_kz}}">
                @error('name_kz')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nameInput">Категория</label>
                <input type="text" class="form-control @error('name_ru') is-invalid @enderror" id="nameInput"
                       name="name_ru" value="{{$category->name_ru}}">
                @error('name_ru')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nameInput">Category</label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="nameInput"
                       name="name_en" value="{{$category->name_en}}">
                @error('name_en')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{asset($category->image)}}" width="100" height="100" alt="">
            </div>
            <div class="form-group">
                <label for="imgInput" class="form-label">{{ __('edits.photo') }}</label>
                <input type="file" value="{{asset($category->image)}}" class="form-control @error('image') is-invalid @enderror" id="imgInput" name="image">
                @error('image')
                <div style="color: red" class="alert col-md-4 col-md-offset-4">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <button type="submit" style="float:right;" class="btn btn-success">{{ __('buttons.save') }}</button>
            </div>
        </form>
@endsection
