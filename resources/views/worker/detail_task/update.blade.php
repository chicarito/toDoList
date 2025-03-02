@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3 fw-normal">Update {{ $task_detail->title }}</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/update-task-detail/{{ $task_detail->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="opacity-50">detail task title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $task_detail->title }}" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="description" class="opacity-50">detail task description</label>
                            <textarea name="desc" id="description" class="form-control">{{ $task_detail->desc }}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status" class="opacity-50">status task description</label>
                            <select name="status" id="status" class="form-select">
                                <option value="0" {{ $task_detail->status == 0 ? 'selected' : '' }}>belum selesai
                                </option>
                                <option value="1" {{ $task_detail->status == 1 ? 'selected' : '' }}>selesai
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image" class="opacity-50">Upload bukti</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                            <div class="card mt-3">
                                <div class="card-body d-flex justify-content-center">
                                    @if ($task_detail->image)
                                        <img src="{{ asset('images/' . $task_detail->image) }}" id="imagePreview"
                                            alt="{{ $task_detail->image }}" class="card-img rounded shadow"
                                            style="max-width: 100%; height: auto; object-fit: cover;">
                                    @else
                                        <img src="" id="imagePreview" alt="Preview Gambar"
                                            class="card-img rounded shadow"
                                            style="max-width: 100%; height: auto; object-fit: cover;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark mt-3 w-100">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            let imagePreview = document.getElementById('imagePreview');
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
