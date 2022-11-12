@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-image">
                            <thead>
                            <tr>
                                <th scope="col">title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Article Name</th>
                                <th scope="col">Author</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1?>
                            @foreach($post->images as $image)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td class="w-25">
                                    <img src="{{asset('images/'.$post->id.'/'.$image->name)}}" class="img-fluid img-thumbnail" alt="Sheep">
                                </td>
                                <td>{{$post->title}}</td>
                                <td>{{auth()->user()->name}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
