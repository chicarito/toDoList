@extends('layout.app')
@section('content')
    <h3 class="text-center my-3">Your quest</h3>
    <div class="row">
        @foreach ($quest as $item)
            <div class="col-md-8 mx-auto my-2">
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>

                        @php
                            // Cek apakah memiliki deadline dan apakah sudah lewat
                            $isExpired = $item->deadline ? $item->deadline->isPast() : false;
                        @endphp

                        @if ($item->deadline)
                            <p>Deadline: {{ $item->deadline->format('d F Y H:i') }} |
                                {{ $item->deadline->diffForHumans() }}
                            </p>

                            @if ($isExpired)
                                <span class="badge rounded-pill text-bg-danger">Expired</span>
                            @endif
                        @else
                            <p>No deadline</p>
                        @endif

                        <hr>
                        <p class="card-text">Description :</p>
                        <p class="card-text">{{ $item->desc ?? 'No description' }}</p>
                        <hr>

                        @if (!isset($item->progress['total']) || $item->progress['total'] == 0)
                            <p>No detail quest</p>
                        @elseif ($item->progress['completed'] == $item->progress['total'])
                            <span class="badge rounded-pill text-bg-success">Completed</span>
                        @else
                            <p>{{ $item->progress['completed'] }} quest completed out of {{ $item->progress['total'] }}</p>
                        @endif

                        <small>
                            <p class="card-text">Created by : {{ $item->creator->name }}</p>
                        </small>

                        @if (!$isExpired || !$item->deadline)
                            <a href="/quest/detail-quest/{{ $item->id }}" class="btn btn-primary mt-3">Kerjakan</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
