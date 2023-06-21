@extends('base')
{{-- titre dinamique --}}
@section("title", $post->title)

@section("content")
    <h4>{{$post->title}}</h4>
        <ul>
            <li>{{$post->content}}</li>
        </ul>
@endsection