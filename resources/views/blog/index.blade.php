{{-- extends fichier racine base.blade.php --}}
@extends('base')
{{-- titre dinamique --}}
@section("title","Accueil du blog")

@section("content")

    <h1>Mon blog</h1>

    @foreach ($posts as $post)

        <h4>{{$post->title}}</h4>
        <p class="small">
            @if($post->category)
                Categorie: <strong>{{$post->category?->name}}</strong> @if(!$post->tags->isEmpty()),@endif
            @endif
            <!-- si la tag existe isEmpty method sur Collection-->
            @if(!$post->tags->isEmpty())
                Tags: 
                <!-- parcourir ensemble des tag -->
                @foreach($post->tags as $tag)
                <span class="badge bg-secondary">{{$tag->name}}</span>
                @endforeach
            @endif
        </p>
        <ul>
            <li>{{$post->content}}</li>
        </ul>
        <p>
            <a href="{{ route("blog.show", ['slug' => $post->slug, 'post'=> $post->id])}}" class="btn btn-primary">Lire la suite</a>
        </p>

    @endforeach
<!-- méthod links permet de génerer le liens -->
   {{ $posts->links()}}
@endsection