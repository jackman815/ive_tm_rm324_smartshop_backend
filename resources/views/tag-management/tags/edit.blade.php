@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tagManagement.tag.title') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("TagManagement.Tags.update", [$tag->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- ---------------------------------name--------------------------------- -->
            <div class="form-group">
                <label class="" for="name">{{ trans('cruds.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $tag->name) }}" >
                @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-- ---------------------------------description--------------------------------- -->
            <div class="form-group">
                <label class="" for="description">{{ trans('cruds.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                    name="description" id="description" value="{{ old('description', $tag->description) }}" >
                @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-- ---------------------------------products--------------------------------- -->
            <div class="form-group">
                <label class="" for="products">{{ trans('cruds.fields.product') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}"
                    name="products[]" id="products" multiple >
                    @foreach($products as $id => $products)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('products', [])) || $tag->hasProduct->contains($id)) ? 'selected' : '' }}>
                        {{ $products }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-- ---------------------------------advertisements--------------------------------- -->
            <div class="form-group">
                <label class="" for="advertisements">{{ trans('cruds.fields.advertisement') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all"
                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all"
                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('advertisements') ? 'is-invalid' : '' }}"
                    name="advertisements[]" id="advertisements" multiple >
                    @foreach($advertisements as $id => $advertisements)
                    <option value="{{ $id }}"
                        {{ (in_array($id, old('advertisements', [])) || $tag->hasAdvertisement->contains($id)) ? 'selected' : '' }}>
                        {{ $advertisements }}</option>
                    @endforeach
                </select>
                @if($errors->has('advertisements'))
                <span class="text-danger">{{ $errors->first('advertisements') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-- ------------------------------------------------------------------ -->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
