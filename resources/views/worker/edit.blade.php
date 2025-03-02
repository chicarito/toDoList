@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3">edit {{ $task->title }}</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/update-task/{{ $task->id }}" method="post">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="assigned_to" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="title" class="opacity-50">task title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $task->title }}" required>
                        </div>

                        <div class="form-group my-1">
                            <label for="desc" class="opacity-50">description</label>
                            <textarea name="desc" id="desc" cols="50" rows="3" class="form-control">{{ $task->desc }}</textarea>
                        </div>
                        <div class="form-group my-1">
                            <label for="deadline" class="opacity-50">deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline" class="form-control"
                                value="{{ $task->deadline }}">
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">update task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
