@extends('layout.app')
@section('content')
    <h3 class="text-center my-3">{{ $quest_detail->title }}</h3>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/quest/post-update/{{ $quest_detail->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="opacity-50">detail task title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $quest_detail->title }}" required disabled>
                        </div>
                        <div class="form-group my-2">
                            <label for="description" class="opacity-50">detail task description</label>
                            <textarea name="desc" id="description" class="form-control" disabled>{{ $quest_detail->desc }}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status" class="opacity-50">status task description</label>
                            <select name="status" id="status" class="form-select">
                                <option value="0" {{ $quest_detail->status == 0 ? 'selected' : '' }}>belum selesai
                                </option>
                                <option value="1" {{ $quest_detail->status == 1 ? 'selected' : '' }}>selesai
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image" class="opacity-50">Upload bukti</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                            <div class="card mt-3">
                                <div class="card-body d-flex justify-content-center">
                                    @if ($quest_detail->image)
                                        <img src="{{ asset('images/' . $quest_detail->image) }}" id="imagePreview"
                                            alt="{{ $quest_detail->image }}" class="card-img rounded shadow"
                                            style="max-width: 100%; height: auto; object-fit: cover;">
                                    @else
                                        <img src="" id="imagePreview" alt="Preview Gambar"
                                            class="card-img rounded shadow"
                                            style="max-width: 100%; height: auto; object-fit: cover;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark mt-3 w-100">Update Quest</button>
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
