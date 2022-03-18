@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.posts.update',$post->id)}}" method="POST">
            @csrf
            @METHOD("PUT")
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" name="title" id="title" placeholder="{{old('title')??$post->title}}">
            </div>
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea name="content" id="content" cols="30" rows="10" placeholder="{{old('content')??$post->content}}"></textarea>
            </div>
            <select class="form-group" aria-label="Default select example" name="cathegory_id" id="cathegory_id">
                <option selected>Seleziona la categoria</option>
                @for ($i=0; $i < $post->totalCathegories(); $i++)
                    <option value="{{$i+1}}">Categoria {{$i+1}}</option>
                @endfor
            </select>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Pubblica</button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
