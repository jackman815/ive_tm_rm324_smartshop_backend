@extends('_layout.admin')
@section('content')
@can('shop_product_inventory_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("ProductManagement.ShopProductInventories.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.productManagement.shop_product_inventory.title') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productManagement.shop_product_inventory.title') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ShopProductInventory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.fields.shop_product') }}
                        </th>
                        <th>
                            {{ trans('cruds.fields.is_sold') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shopProductInventories as $key => $shopProductInventory)
                    <tr data-entry-id="{{ $shopProductInventory->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $shopProductInventory->id ?? '' }}
                        </td>
                        <td>
                            @include('_module.datatable.badge_tag.tag',[
                            'type' => config('constant.badge_type')['name'],
                            'element' => $shopProductInventory->hasShopProduct->hasProduct->id . ". " .
                            $shopProductInventory->hasShopProduct->hasProduct->name ?? '',
                            ])
                        </td>
                        <td>
                            @include('_module.datatable.badge_tag.tag',[
                            'type' => config('constant.badge_type')[config('constant.shopProductInventories_isSold')[$shopProductInventory->is_sold]],
                            'element' => config('constant.shopProductInventories_isSold')[$shopProductInventory->is_sold] ?? '',
                            ])
                        </td>
                        <td>
                            @include('_module.datatable.action.index',[
                            'permission_subject' => 'shop_product_inventory',
                            'route_subject' => 'ProductManagement.ShopProductInventories',
                            'id' => $shopProductInventory->id
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
@include('_module.datatable.massdestory',[
'permission_massDestory' => 'shop_product_inventory_delete',
'route' => route('ProductManagement.ShopProductInventories.massDestroy'),
'pageLength' => 25,
'class' => 'datatable-ShopProductInventory'
])
@endsection