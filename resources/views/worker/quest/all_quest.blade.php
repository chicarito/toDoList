@extends('layout.app')
@section('content')
    <h3 class="text-center my-3">Your quest</h3>
    <div class="row">
        @foreach ($quest as $item)
            <div class="col-md-4 my-2">
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($item->title, 30) }}</h5>
                        <p>Deadline : {{ $item->deadline->diffForHumans() }}</p>
                        <hr>
                        <p class="card-text">Description :</p>
                        <p class="card-text">{{ Str::limit($item->desc, 30) ?? 'no description' }}</p>
                        <hr>
                        @if (!isset($item->progress['total']) || $item->progress['total'] == 0)
                            <p>No detail quest</p>
                        @elseif ($item->progress['completed'] == $item->progress['total'])
                            <span class="badge rounded-pill text-bg-success">Completed</span>
                        @else
                            <p>{{ $item->progress['completed'] }} quest completed out of
                                {{ $item->progress['total'] }}</p>
                        @endif
                        <small>
                            <p class="card-text">Created by : {{ $item->creator->name }}</p>
                        </small>
                        <a href="/quest/detail-quest/{{ $item->id }}" class="btn btn-primary mt-3">Kerjakan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
