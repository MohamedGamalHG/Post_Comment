@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form  action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label >Title</label>
                        <textarea name="title" class="form-control" palceholder="title" rows="3" cols="20" required></textarea>
                        <input type="file" name="images[]" class="mb-3 mt-3 form-control" accept="image/*" multiple required >
                        <input type="submit" value="Send" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
