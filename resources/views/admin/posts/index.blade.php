@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="post py-4">
                <h2 class="text-center">{{$post['title']}}</h2>
                <p>{{$post['content']}}</p>
            </div>
            <a href="{{route('admin.posts.show',$post->id)}}">Vedi questo post</a>
        @endforeach
    </div>
    <a href="{{route('admin.posts.create')}}">Crea un nuovo post</a>
@endsection