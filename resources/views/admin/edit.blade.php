@extends('layout.app')
@section('content')
    <h1 class="h3 text-center fw-semibold my-3">Kelola Pengguna</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="modal-body">
                        <form action="/update-user/{{ $user->id }}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-bottom-0" name="name" id="name"
                                    placeholder="name" value="{{ $user->name }}" required>
                                <label for="name">Nama</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-0 @error('username') is-invalid @enderror"
                                    name="username" id="username" placeholder="username" value="{{ $user->username }}"
                                    required>
                                <label for="username">Username</label>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-0" name="password" id="password"
                                    placeholder="password">
                                <label for="password">Password</label>
                            </div>
                            <select name="role" id="role" class="form-select rounded-top-0" required>
                                <option value="">pilih role</option>
                                <option value="tasker" {{ $user->role == 'tasker' ? 'selected' : '' }}>tasker</option>
                                <option value="worker" {{ $user->role == 'worker' ? 'selected' : '' }}>worker</option>
                            </select>

                            <button type="submit" class="btn btn-dark w-100 my-3">update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
