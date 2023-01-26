@extends('layouts.app')

@section('title','categories page')

@section('content')
    <div class="container">
        <a href="{{url('/')}}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
            </svg></a>
        <div class="row">
            @for($i=0;$i<count($categories); $i++)
                    <div class="col-4 mt-3">
                        <a href="{{route('shops.category', $categories[$i]->id)}}">
                            <div class="card text-center" style="color: black">
                                <img src="{{asset($categories[$i]->image)}}"
                                     class="card-img-top"
                                     width="250" height="300"/>
                                <div class="card-body">
                                    <h5 class="card-title">{{$categories[$i]->{'name_'.app()->getLocale()} }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
            @endfor
        </div>
    </div>
@endsection
