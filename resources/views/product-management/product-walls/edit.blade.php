@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productManagement.product_wall.title') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("ProductManagement.ProductWalls.update", [$productWall->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-------------------------------------qrcode------------------------------------->
            <div class="form-group">
                <label class="" for="qrcode">{{ trans('cruds.fields.qrcode') }}</label>
                <input class="form-control {{ $errors->has('qrcode') ? 'is-invalid' : '' }}" type="text" name="qrcode"
                    id="qrcode" value="{{ old('qrcode', $productWall->qrcode) }}" >
                @if($errors->has('qrcode'))
                <span class="text-danger">{{ $errors->first('qrcode') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!---------------------------product_id--------------------------->
            <div class="form-group">
                <label class="" for="product_id">{{ trans('cruds.fields.product_id') }}</label>
                <input class="form-control {{ $errors->has('product_id') ? 'is-invalid' : '' }}" type="text"
                    name="product_id" id="product_id" value="{{ old('product_id', $productWall->product_id) }}"
                    >
                @if($errors->has('product_id'))
                <span class="text-danger">{{ $errors->first('product_id') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-------------------------------------product_id------------------------------------->
            <div class="form-group">
                <label class="" for="product_id">{{ trans('cruds.fields.product_id') }}</label>
                <select class="form-control select {{ $errors->has('product_id') ? 'is-invalid' : '' }}"
                    name="product_id" id="product_id" >
                    <option value disabled {{ old('product_id', $productWall->product_id) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach($products as $key => $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $productWall->product_id) === $key ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('product_id'))
                <span class="text-danger">{{ $errors->first('product_id') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!---------------------------message--------------------------->
            <div class="form-group">
                <label class="" for="message">{{ trans('cruds.fields.message') }}</label>
                <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" type="text" name="message"
                    id="message" value="{{ old('message', $productWall->message) }}" >
                @if($errors->has('message'))
                <span class="text-danger">{{ $errors->first('message') }}</span>
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
