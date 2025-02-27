@extends('_layout.admin')
@section('content')
@can('shop_product_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("ProductManagement.ShopProducts.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.productManagement.shop_product.title') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productManagement.shop_product.title') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ShopProduct">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.fields.qrcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.fields.product') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shopProducts as $key => $shopProduct)
                    <tr data-entry-id="{{ $shopProduct->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $shopProduct->id ?? '' }}
                        </td>
                        <td>
                            <img src="{{ 'https://chart.apis.google.com/chart?cht=qr&chs=500x500&chld=L%7C0&chl=' . $shopProduct->qrcode }}"
                                 width="100px">
                        </td>
                        <td>
                            @include('_module.datatable.badge_tag.tag',[
                            'type' => config('constant.badge_type')['name'],
                            'element' => $shopProduct->hasProduct->id . ". " . $shopProduct->hasProduct->name ?? '',
                            ])
                        </td>
                        <td>
                            @include('_module.datatable.action.index',[
                            'permission_subject' => 'shop_product',
                            'route_subject' => 'ProductManagement.ShopProducts',
                            'id' => $shopProduct->id
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
'permission_massDestory' => 'shop_product_delete',
'route' => route('ProductManagement.ShopProducts.massDestroy'),
'pageLength' => 25,
'class' => 'datatable-ShopProduct'
])
@endsection
