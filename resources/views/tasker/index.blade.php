@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3">Make a quest...</h1>

    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- form add quest --}}
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/add-quest" method="post">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="title" class="opacity-50">question title</label>
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
                        <div class="form-group">
                            <label for="assigned_to" class="opacity-50">select worker</label>
                            <select name="assigned_to" id="formSelect" class="form-select" required>
                                <option value="" selected>--select worker--</option>
                                @foreach ($getUser as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">add quest</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- all quests --}}
    <div class="col-md-9 mx-auto mt-3">
        <div class="row">
            <div class="col-6">
                <p class="">recent quest</p>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="/all-quest" class="text-decoration-none text-dark">all quest</a>
            </div>
        </div>

        @foreach ($quest as $item)
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
                            @if ($item->desc)
                                <p>{{ $item->desc }}</p>
                            @else
                                <p>no description</p>
                            @endif
                            <p>Assigned to: {{ $item->assignee->name }}</p>
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
                                    <a href="/add-detail-quest/{{ $item->id }}" class="btn btn-primary">detail task</a>
                                    <a href="/edit-quest/{{ $item->id }}" class="btn btn-warning mx-2">edit</a>
                                    <a href="/delete-quest/{{ $item->id }}" class="btn btn-danger"
                                        onclick="return confirm('hapus {{ $item->title }}?')">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
