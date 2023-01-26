@extends('layouts.adm')
@section('title','Cart page')
@section('content')
    <h1> Promocode </h1>
    <a href="{{route('adm.promocode.create')}}" class="btn btn-success">Create Promocode</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Promocode</th>
            <th scope="col">Price</th>
            <th scope="col">{{ __('buttons.delete') }}</th>

        </tr>
        </thead>
        <tbody>
        @for($i=0;$i<count($promocodes);$i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$promocodes[$i]->promocode}}</td>
                <td>{{$promocodes[$i]->price}} KZT</td>
                <td><form action="{{route('adm.promocode.destroy',$promocodes[$i]->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{__('buttons.delete')}}</button>
                    </form>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>

@endsection
