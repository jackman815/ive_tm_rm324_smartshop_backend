@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.smartBankManagement.stock.title') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("SmartBankManagement.Stocks.update", [$stock->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!---------------------------code--------------------------->
            <div class="form-group">
                <label class="" for="code">{{ trans('cruds.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                    id="code" value="{{ old('code', $stock->code) }}" >
                @if($errors->has('code'))
                <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-------------------------------------icon------------------------------------->
            {{--
            <div class="form-group">
                <label class="" for="icon">{{ trans('cruds.fields.icon') }}</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('icon') ? 'is-invalid' : '' }}"
                            id="icon" name="icon">
                        <label class="custom-file-label" for="icon">{{ old('icon', $stock->icon) }}</label>
                    </div>
                </div>
            </div>
            --}}
            <!---------------------------name--------------------------->
            <div class="form-group">
                <label class="" for="name">{{ trans('cruds.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $stock->name) }}" >
                @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!---------------------------data--------------------------->
            {{--
            <div class="form-group">
                <label class="" for="data">{{ trans('cruds.fields.data') }}</label>
                <input class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data"
                    id="data" value="{{ old('data', $stock->data) }}" >
                @if($errors->has('data'))
                <span class="text-danger">{{ $errors->first('data') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            --}}
            <!---------------------------description--------------------------->
            <div class="form-group">
                <label class="" for="description">{{ trans('cruds.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                    name="description" id="description" value="{{ old('description', $stock->description) }}" >
                @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!------------------------------------------------------>
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
