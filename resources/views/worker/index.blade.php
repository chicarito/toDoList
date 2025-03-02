@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3">Make a task...</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/add-task" method="post">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="assigned_to" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="title" class="opacity-50">task title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group my-1">
                            <label for="desc" class="opacity-50">description</label>
                            <textarea name="desc" id="desc" cols="50" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group my-1">
                            <label for="deadline" class="opacity-50">deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">add task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 mx-auto mt-3">
        <div class="row">
            <div class="col-6">
                <p class="">recent task</p>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/all-task" class="text-decoration-none text-dark">all task</a>
            </div>
        </div>


        @forelse ($task as $item)
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">{{ $item->title }}</h4>
                            @if ($item->deadline)
                                <p>deadline: {{ $item->deadline->format('d F Y H:i') }} |
                                    {{ $item->deadline->diffForHumans() }}</p>
                            @else
                                <p>no deadline</p>
                            @endif
                            <hr>

                            <p>{{ $item->desc ?? 'no description' }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    @if (!isset($item->progress['total']) || $item->progress['total'] == 0)
                                        <p>No detail quest</p>
                                    @elseif ($item->progress['completed'] == $item->progress['total'])
                                        <span class="badge rounded-pill text-bg-success">Completed</span>
                                    @else
                                        <p>{{ $item->progress['completed'] }} quest completed out of
                                            {{ $item->progress['total'] }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <a href="/add-task-detail/{{ $item->id }}" class="btn btn-primary">detail task</a>
                                    <a href="/edit-task/{{ $item->id }}" class="btn btn-warning mx-2">edit</a>
                                    <a href="/delete-task/{{ $item->id }}" class="btn btn-danger">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">no task</p>
        @endforelse
    </div>
@endsection
