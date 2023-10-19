@extends('layouts.app')

@section('content')
    <h1>Create new page
        <a href="/pages/new"> <img src="{{ asset('img/plus-solid.svg') }}" alt="+"> </a>
    </h1>
    @foreach ($pages as $page)
        <a href="{{ route('pages.index', $page->page_number) }}">{{$page->name}}</a>
    @endforeach
@endsection
