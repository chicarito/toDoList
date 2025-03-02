@extends('layout.app')
@section('content')
    <h1 class="h3 text-center my-3 fw-normal">{{ $quest->title }}</h1>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/update-quest/{{ $quest->id }}" method="post">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="title" class="opacity-50">question title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $quest->title }}">
                        </div>
                        <div class="form-group my-1">
                            <label for="desc" class="opacity-50">description</label>
                            <textarea name="desc" id="desc" cols="50" rows="3" class="form-control">{{ $quest->desc }}</textarea>
                        </div>
                        <div class="form-group my-1">
                            <label for="deadline" class="opacity-50">deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="{{ $quest->deadline }}">
                        </div>
                        <div class="form-group">
                            <label for="assigned_to" class="opacity-50">select worker</label>
                            <select name="assigned_to" id="formSelect" class="form-select">
                                <option value="{{ $quest->assignee->id }}" selected>{{ $quest->assignee->name }}</option>
                                @foreach ($getUser as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">update quest</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
