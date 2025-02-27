<?php

namespace App\Http\Controllers\ProductManagement\VendingMachine;

use App\Models\ProductManagement\VendingMachine\VendingProduct;
use App\Models\ProductManagement\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// massDestroy
use App\Http\Requests\MassDestroyVendingProductRequest;
use App\Http\Requests\StoreVendingProductRequest;
use App\Http\Requests\UpdateVendingProductRequest;
use Symfony\Component\HttpFoundation\Response;

class VendingProductController extends Controller
{
    public function index()
    {
        $vendingProducts = VendingProduct::all();
        return view('product-management.vending-machine.vending-products.index', compact('vendingProducts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('product-management.vending-machine.vending-products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'    => 'required',
            'channel'       => 'required|unique:vending_products',
        ]);
        $vendingProduct = VendingProduct::create($request->all());
        // $remittanceTransaction->hasTransaction()->sync($request->input('hasTransaction', []));
        return redirect()->route('ProductManagement.VendingProducts.index');
    }

    public function show(VendingProduct $vendingProduct)
    {
        // $product->load('hasTransaction');
        return view('product-management.vending-machine.vending-products.show', compact('vendingProduct'));
    }

    public function edit(VendingProduct $vendingProduct)
    {
        // $transactions = Transaction::all()->pluck('id');
        // $product->load('hasTransaction');
        $products = Product::all();
        return view('product-management.vending-machine.vending-products.edit', compact('vendingProduct', 'products'));
    }

    public function update(Request $request, VendingProduct $vendingProduct)
    {
        $request->validate([
            'product_id'    => 'required',
            'channel'       => 'required|unique:vending_products,channel' . ($vendingProduct->id ? ",$vendingProduct->id" : ''),
        ]);
        $vendingProduct->update($request->all());
        // $remittanceTransaction->hasPermission()->sync($request->input('permissions', []));
        return redirect()->route('ProductManagement.VendingProducts.index');
    }

    public function destroy(VendingProduct $vendingProduct)
    {
        $vendingProduct->delete();
        return back();
    }

    public function massDestroy(MassDestroyVendingProductRequest $request)
    {
        VendingProduct::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
