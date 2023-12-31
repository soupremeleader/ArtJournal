<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body id="body">
<h1>{{ $number }}</h1>
@if($text_blocks !== null)
    @if($isOwner)
        @foreach ($text_blocks as $text_block)
            <input type="text" value={{$text_block->content}}>
        @endforeach
    @else
        @foreach ($text_blocks as $text_block)
            <p>{{$text_block->content}}</p>
        @endforeach
    @endif
@endif
<form id="text-editor" method="POST" action="{{route("textblocks.store", $number)}}">
    @csrf
</form>
</body>
</html>


