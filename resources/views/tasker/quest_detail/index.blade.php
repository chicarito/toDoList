@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3">add detail quest</h1>

    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/add-quest-detail" method="post">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $quest->id }}">
                        <div class="form-group">
                            <label for="title" class="opacity-50">detail question title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="opacity-50">detail question description</label>
                            <textarea name="desc" id="desc" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">add quest</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mt-5">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($task_detail as $item)
                    <tr class="text-center align-middle text-nowrap">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->desc, 20) ?? 'no description' }}</td>
                        <td>{{ $item->status ? 'selesai' : 'belum selesai' }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('images/' . $item->image) }}" width="100" class="img-fluid">
                            @else
                                no image
                            @endif
                        </td>
                        <td>
                            <a href="/edit-quest-detail/{{ $item->id }}" class="btn btn-primary">edit</a>
                            <a href="/delete-quest-detail/{{ $item->id }}" class="btn btn-danger"
                                onclick="return confirm('hapus {{ $item->title }}?')">delete</a>
                            <a href="/show-quest-detail/{{ $item->id }}" class="btn btn-success">show</a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">No task detail</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
