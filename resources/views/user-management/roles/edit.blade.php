@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userManagement.role.title') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("UserManagement.Roles.update", [$role->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!---------------------------name--------------------------->
            <div class="form-group">
                <label class="" for="name">{{ trans('cruds.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $role->name) }}">
                @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!---------------------------description--------------------------->
            <div class="form-group">
                <label class="" for="description">{{ trans('cruds.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $role->description) }}">
                @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-- --------------------------------------permission-------------------------------------- -->
            <div class="form-group">
                <label for="permissions">{{ trans('cruds.fields.permission') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]"
                    id="permissions" multiple>
                    @foreach($permissions as $id => $permissions)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('permissions', [])) || $role->hasPermission->contains($id)) ? 'selected' : '' }}>
                        {{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                <span class="text-danger">{{ $errors->first('permissions') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-- ------------------------------------------------------------------------ -->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection