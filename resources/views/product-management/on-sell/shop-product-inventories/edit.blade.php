@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productManagement.shop_product_inventory.title') }}
    </div>
    <div class="card-body">
        <form method="POST"
            action="{{ route("ProductManagement.ShopProductInventories.update", [$shopProductInventory->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- --------------------------------------shop_product_id-------------------------------------- -->
            <div class="form-group">
                <label class="" for="shop_product_id">{{ trans('cruds.fields.shop_product_id') }}</label>
                <select class="form-control select2 {{ $errors->has('shop_product_id') ? 'is-invalid' : '' }}"
                    name="shop_product_id" id="shop_product_id" >
                    <option value disabled
                        {{ old('shop_product_id', $shopProductInventory->shop_product_id) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach($shopProducts as $key => $shopProduct)
                    <option value="{{ $shopProduct->id }}"
                        {{ $shopProduct->id == $shopProductInventory->shop_product_id ? 'selected' : '' }}>
                        {{ $shopProduct->hasProduct->name }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('shop_product_id'))
                <span class="text-danger">{{ $errors->first('shop_product_id') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-------------------------------------rfid_code------------------------------------->
            <div class="form-group">
                <label class="" for="rfid_code">{{ trans('cruds.fields.rfid_code') }}</label>
                <input class="form-control {{ $errors->has('rfid_code') ? 'is-invalid' : '' }}" type="text"
                    name="rfid_code" id="rfid_code" value="{{ old('rfid_code', $shopProductInventory->rfid_code) }}"
                    >
                @if($errors->has('rfid_code'))
                <span class="text-danger">{{ $errors->first('rfid_code') }}</span>
                @endif
                <span class="help-block"> </span>
            </div>
            <!-------------------------------------is_sold------------------------------------->
            <div class="form-group">
                <label class="" for="is_sold">{{ trans('cruds.fields.is_sold') }}</label>
                <select class="form-control select {{ $errors->has('is_sold') ? 'is-invalid' : '' }}" name="is_sold"
                    id="is_sold" >
                    <option value disabled
                        {{ old('is_sold', $shopProductInventory->is_sold) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach(config('constant.shopProductInventories_isSold') as $key => $label)
                    <option value="{{ $key }}" {{ old('is_sold', $shopProductInventory->is_sold) === $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('is_sold'))
                <span class="text-danger">{{ $errors->first('is_sold') }}</span>
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
