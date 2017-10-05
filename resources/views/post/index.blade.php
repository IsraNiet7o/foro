@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>
                {{ $category->exists ? 'Post de '.$category->name : 'Post' }}
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <h4>Filtros</h4>
            {!! Menu::make(trans('menu.filters'), 'nav filters') !!}
            <h4>Categorías</h4>
            {!! Menu::make($categoryItems, 'nav categories') !!}
        </div>
        <div class="col-md-10">
            {!! Form::open(['method'=> 'get', 'class'=> 'form form-inline']) !!}

                {!! Form::select('orden', config('options.post-order'),request()->get('orden'), ['class'=> 'form-control'] ) !!}
                <button type="submit" class="btn btn-default">Ordenar</button>
            {!! Form::close() !!}

            @each('post.item', $posts, 'post')

            {{ $posts->appends(request()->intersect(['orden']))->render() }}
        </div>
    </div>
@endsection