@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3 fw-normal">update {{ $task_detail->title }}</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/update-quest-detail/{{ $task_detail->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="opacity-50">title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $task_detail->title }}">
                        </div>
                        <div class="form-group">
                            <label for="desc" class="opacity-50">description</label>
                            <textarea name="desc" id="desc" class="form-control">{{ $task_detail->desc }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
