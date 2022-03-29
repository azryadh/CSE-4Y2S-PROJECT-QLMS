@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
           Role Edit
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.roles.update", [$role->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">Role Tile</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label class="required" for="permissions">Permission</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Select</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Select All</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                        @foreach($permissions as $id => $permissions)
                            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                    <span class="help-block">Permissions</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger float-lg-right" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
