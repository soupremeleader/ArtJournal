@extends('layouts.app')

@section('content')

    <h1>Create new page
        <a href="/pages/new"> <img src="{{ asset('img/plus-solid.svg') }}" alt="+"> </a>
    </h1>
    @foreach ($tags as $tag)
        <a href="{{ route('pages.index', $tag->page_number) }}">{{$tag->name}}</a>
        <p>{{$tag->tag_name}}</p>
    @endforeach
@endsection
