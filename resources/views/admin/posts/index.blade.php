@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="post py-4">
                <h2 class="text-center">{{$post['title']}}</h2>
                <p>{{$post['content']}}</p>
            </div>
        @endforeach
    </div>
@endsection