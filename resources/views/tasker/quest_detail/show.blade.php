@extends('layout.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Gambar -->
                    @if ($quest_detail->image)
                        <img src="{{ asset('images/' . $quest_detail->image) }}" alt="" class="card-img-top">
                    @else
                        <img src="https://placehold.co/500x300?text=No+Image" class="card-img-top" alt="Gambar Tugas">
                    @endif
                    <div class="card-body">
                        <!-- Judul -->
                        <h4 class="card-title">{{ $quest_detail->title }}</h4>

                        <!-- Deskripsi -->
                        <p class="card-text">{{ $quest_detail->desc ?? 'no description' }}</p>

                        <!-- Status -->
                        <span
                            class="badge {{ $quest_detail->status ? 'bg-success' : 'bg-danger' }}">{{ $quest_detail->status ? 'Selesai' : 'Belum Selesai' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
