@extends('layout.app')
@section('content')
    <div class="col-md-9 mx-auto mt-3">
        <h1 class="h3 text-center my-3">All Task</h1>

        @foreach ($task as $item)
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
