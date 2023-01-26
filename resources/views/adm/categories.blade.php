@extends('layouts.adm')

@section('title','categories page')

@section('content')
    <h1>{{ __('category.categories page') }}</h1>
    <a class="btn btn-primary mb-2" href="{{route('adm.categories.create')}}">{{ __('category.create category') }}</a>
    <table class="table" width="100%">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Санаттар</th>
            <th scope="col">Categories</th>
            <th scope="col">Категории</th>
            <th>{{ __('buttons.edit') }}</th>
            <th>{{ __('buttons.delete') }}</th>
        </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($categories); $i++)
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$categories[$i]->name_kz }}</td>
                    <td>{{$categories[$i]->name_en }}</td>
                    <td>{{$categories[$i]->name_ru }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('adm.categories.edit', $categories[$i]->id)}}">{{ __('buttons.edit') }}</a>
                    <td>
                        <form method="post" action="{{route('adm.categories.destroy', $categories[$i]->id)}}">
                            @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">{{ __('buttons.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endfor
        </tbody>
      </table>
@endsection
