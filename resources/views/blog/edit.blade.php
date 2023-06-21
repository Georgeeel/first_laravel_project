{{-- extends fichier racine base.blade.php --}}
@extends('base')
{{-- titre dinamique --}}
@section("title","Modifier un article")

@section("content")
    <h3 class="mt-4">Page article</h3>
    @include('blog.form')
@endsection