@extends('layouts.app')

@section('content')

    <h1>Create new page
        <a href="/pages/new"> <img src="{{ asset('img/plus-solid.svg') }}" alt="+"> </a>
    </h1>

    <form method="GET" action="/get">
        <label for="filterInput">Search:</label>
        <input type="text" name="filterInput" id="filterInput" placeholder="search"/>
        <input type="submit" value="GO"/>
    </form>

    @if($filter !== null)
        <p>{{$filter}}
            <a href="{{ route('home') }}">X</a>
        </p>
    @endif
    <main id="main">
        @foreach ($tags as $tag)
            <a href="{{ route('pages.index', $tag->page_number) }}">{{$tag->name}}</a>
            <p>{{$tag->tag_name}}</p>
        @endforeach
    </main>
@endsection
