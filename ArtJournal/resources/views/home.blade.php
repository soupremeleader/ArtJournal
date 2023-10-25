@extends('layouts.app')

@section('content')

    <a href="{{route('home')}}">home</a>
    @if($isLoggedIn)
        <a href="{{route('MyJournal', $userName)}}">My Journal</a>

        <h1>Create new page
            <a href="/pages/new"> <img src="{{ asset('img/plus-solid.svg') }}" alt="+"> </a>
        </h1>
    @else
        <h1>Create new page
            <a href={{ route('login') }}> <img src="{{ asset('img/plus-solid.svg') }}" alt="+"> </a>
        </h1>
    @endif

    <form method="GET" action="/get">
        <label for="filterInput">Search:</label>
        <input type="text" name="filterInput" id="filterInput" placeholder="search"/>
        <label for="filterTagInput">Filter tags:</label>
        <select type="dropdown" name="filterTagInput" id="filterTagInput">
            <option></option>
            @foreach($existingTags as $tag)
                <option>{{$tag->tag_name}}</option>
            @endforeach
        </select>
        <input type="submit" value="GO"/>
    </form>

    @if($filter !== null)
        <p>{{$filter}}
            <a href="{{ route('home') }}">X</a>
        </p>
    @endif
    <main id="main">
        @foreach ($tags as $tag)
            <a href="{{ route('pages.index', $tag->page_number) }}">{{$tag->page_name}}</a>
            @if ($userName === $tag->name)
                <a href="{{route('pages.edit', [$userName, $tag->page_number])}}">edit</a>
            @endif
            @if($userName === $tag->name || $isAdmin)
                <a href="{{route('pages.delete', [$userName, $tag->page_number])}}">delete</a>
            @endif

            <a href="{{route('MyJournal', $tag->name)}}">{{$tag->name}}</a>
            <p>{{$tag->tag_name}}</p>
        @endforeach
    </main>

@endsection
