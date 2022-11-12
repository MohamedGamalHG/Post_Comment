@extends('layouts.app')

@section('content')
    <div class="container">
        <span class="btn-success ">All Post </span>
        <div class="row justify-content-center">
            <?php $i=1?>
            @foreach($posts as $post)
            <div class="card mb-5 mt-3">
                <div class="card-body">
                    <h5 class="card-title">Post {{$i++}}</h5>
                    <p class="card-text">{{$post->title}}</p>
                    <p class="card-text"><small class="text-muted">Last updated {{$post->date}}</small></p>
                    <a href="{{route('user.show',$post->id)}}" class="btn btn-primary" style="text-decoration: none">Read More</a>
                </div>

                @if(isset($post->images[0]->name))
                <img src="{{asset('images/'.$post->id.'/'.$post->images[0]->name)}}" class="card-img-bottom" alt="...">
                    @endif
            </div>
                @endforeach
        </div>
    </div>
@endsection
