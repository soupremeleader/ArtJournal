@extends('layouts.app')

@section('content')
    <h1>Create new page
    </h1>
    @if($edit)
        <form id="page_name" method="POST" action="{{route('pages.update', [$user, $page_number])}}">
    @else
        <form id="page_name" method="POST" action="{{route('pages.store')}}">
    @endif
            @csrf
            <label for="page_title">Title:</label>
    @if($edit)
            <input type="text" id="page_title" name="page_title" placeholder="title"
                   value={{$potential_title->page_name}} required>
            <label for="isPublicCheckbox">Make this page public?</label>
            <input id="isPublicCheckbox"
                   name="isPublicCheckbox"
                   type="checkbox"
                   value={{$potential_title->is_public}}>
    @else
            <input type="text" id="page_title" name="page_title" placeholder="title"
                   value={{$potential_title}} required>
            <label for="isPublicCheckbox">Make this page public?</label>
            <input id="isPublicCheckbox"
                   name="isPublicCheckbox"
                   type="checkbox">
    @endif
            <p>{{$error}}</p>
            <label for="tags_input" id="tags_label">Tags:</label>
            <input type="text" id="tags_input" name="tags_input" placeholder="Add tags here" list="data_tags"
            @if($edit)
                value="{{$potential_title->tag_name}}"
            @endif>
            <datalist id="data_tags"></datalist>
            <input type="submit" value="GO"/>
        </form>
        @endsection
