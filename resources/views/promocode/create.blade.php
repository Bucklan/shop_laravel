@extends('layouts.adm')
@section('content')
    <form action="{{route('adm.promocode.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="titleInput">{{ __('messages.Title') }}</label>
            <input type="text" class="form-control @error('promocode') is-invalid @enderror" id="titleInput"
                   name="promocode"
                   placeholder="promocode">
            @error('promocode')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="titleInput">{{ __('messages.Price') }}</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="titleInput"
                   name="price"
                   placeholder="{{__('messages.Price')}}">
            @error('price')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-success">{{__('buttons.send')}}</button>
        </div>
    </form>
@endsection
