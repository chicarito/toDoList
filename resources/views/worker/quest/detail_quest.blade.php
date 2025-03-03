@extends('layout.app')
@section('content')
    <h3 class="text-center my-3">{{ $quest->title }}</h3>
    <div class="table-responsive">
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
                    @forelse ($quest_detail as $item)
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
                                <a href="/quest/update-quest/{{ $item->id }}" class="btn btn-primary">update</a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="6">No task</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
