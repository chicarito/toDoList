@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3 fw-normal">add detail task</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/store-task-detail" method="post">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="form-group">
                            <label for="title" class="opacity-50">detail task title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description" class="opacity-50">detail task description</label>
                            <textarea name="desc" id="description" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">add quest</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered mt-5 table-sm">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Title</th>
                    <th>Description </th>
                    <th>Status</th>
                    <th>Image</th>
                    <th></th>
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
                            <a href="/edit-task-detail/{{ $item->id }}" class="btn btn-primary">update</a>
                            <a href="/delete-quest-detail/{{ $item->id }}" class="btn btn-danger">delete</a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4">No task detail</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
