@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            Create
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.permissions.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="title">Permission title</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
