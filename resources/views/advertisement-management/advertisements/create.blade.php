@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.advertisementManagement.advertisement.title') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("AdvertisementManagement.ad.store") }}" enctype="multipart/form-data">
            @csrf
            <!-- ------------------------------------header------------------------------------ -->
            <div class="form-group">
                <label class="" for="header">{{ trans('cruds.fields.header') }}</label>
                <input class="form-control {{ $errors->has('header') ? 'is-invalid' : '' }}" type="text" name="header"
                    id="header" value="{{ old('header', '') }}" >
                @if($errors->has('header'))
                <span class="text-danger">{{ $errors->first('header') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-- ------------------------------------image------------------------------------ -->
            <div class="form-group">
                <label class="" for="image">{{ trans('cruds.fields.image') }}</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------description------------------------------------ -->
            <div class="form-group">
                <label for="description">{{ trans('cruds.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                    name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-- --------------------------------------status-------------------------------------- -->
            <div class="form-group">
                <label class="" for="status">{{ trans('cruds.fields.status') }}</label>
                <select class="form-control select {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                    id="status" >
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach(config('constant.advertisement_status') as $key => $label)
                    <option value="{{ $key }}" {{ old('status') === $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-- --------------------------------------tags-------------------------------------- -->
            <div class="form-group">
                <label for="tags">{{ trans('cruds.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]"
                    id="tags" multiple>
                    @foreach($tags as $id => $tags)
                    <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tags }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-- ---------------------------------------------------------------------------- -->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
            bsCustomFileInput.init();
        });
</script>
@endsection
