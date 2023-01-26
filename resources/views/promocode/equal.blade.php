@extends('layouts.app')
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('promocode.equal')}}" method="post">
                        @csrf
                        <input type="text" placeholder="Promocode" name="promocode" class="form-control">
                        <button class="btn btn-success">{{__('buttons.send')}}</button>
                    </form>
                </div>
            </div>
        </div>

    @endsection
