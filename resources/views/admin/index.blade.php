@extends('layout.app')
@section('content')
    <h1 class="h3 text-center fw-semibold my-3">Kelola Pengguna</h1>

    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- form add user --}}
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/store-user" method="post" autocomplete="off">
                        @csrf
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-bottom-0 rounded-top-1" name="name"
                                id="name" placeholder="name" value="{{ old('name') }}" required>
                            <label for="name">Nama</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-0 @error('username') is-invalid @enderror"
                                name="username" id="username" placeholder="username" value="{{ old('username') }}" required>
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-0" name="password" id="password"
                                placeholder="password" required>
                            <label for="password">Password</label>
                        </div>
                        <select name="role" id="role" class="form-select rounded-top-0 rounded-bottom-1 mb-3" required>
                            <option value="">pilih role</option>
                            <option value="tasker">tasker</option>
                            <option value="worker">worker</option>
                        </select>
                        <button type="submit" class="btn btn-dark w-100 my-3">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- show all users --}}
    <div class="table-responsive mt-5">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr class="text-center text-nowrap align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->role }}</td>
                        <td>
                            <a href="/edit-user/{{ $item->id }}" class="btn btn-primary">edit</a>
                            <a href="/delete-user/{{ $item->id }}" class="btn btn-danger"
                                onclick="return confirm('hapus {{ $item->name }}?')">hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
