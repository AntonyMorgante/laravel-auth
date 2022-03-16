@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="post py-4">
            <h2 class="text-center">{{$post['title']}}</h2>
            <p>{{$post['content']}}</p>
        </div>
    </div>
    <div><a href="{{route('admin.posts.edit', $post->id)}}">Modifica</a>
    <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo post?')">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Elimina</button>
    </form>
@endsection