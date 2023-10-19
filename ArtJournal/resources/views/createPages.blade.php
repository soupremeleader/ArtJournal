@extends('layouts.app')

@section('content')
    <h1>Create new page
    </h1>
    <form id="page_name" method="POST" action="{{route('pages.store')}}">
        @csrf
        <label for="page_title">Title:</label>
        <input type="text" id="page_title" name="page_title" placeholder="title" value={{$potential_title}}>
        <input type="submit" value="GO"/>
    </form>
@endsection