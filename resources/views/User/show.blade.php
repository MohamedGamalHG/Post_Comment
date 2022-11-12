@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a href="{{route('user.index')}}" style="text-decoration: none">Back to All Post</a>

            <div class="card mb-5 mt-3">
                    <div class="card-body">
                        <p class="card-text">{{$post->title}}</p>
                        <p class="card-text"><small class="text-muted">Last updated {{$post->date}}</small></p>
                    </div>
                </div>

            <form action="{{route('user.store')}}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <input type="text" name="comment" class="form-control mb-1" placeholder="comment here ......">
                @if(auth()->user())
                <input class="btn btn-primary" type="submit" value="Comment">
                @endif
            </form>

        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            @foreach($post_comment->comments as $comment)
            <div class="card mb-2 mt-2">
                <div class="card-body">
                    <p class="card-text">{{$comment->content}}</p>
                </div>
        </div>
            @endforeach
    </div>
    </div>

@endsection
