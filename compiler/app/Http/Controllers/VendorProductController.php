<?php

namespace App\Http\Controllers;

use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\VendorProductResource;
class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_products = VendorProduct::all();
        return new VendorProductResource($vendor_products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'note' => 'sometimes|required|max:255',
            'price'=>'integer',
            'vendor_id'=>'required|exists:vendors,id',
            'product_id'=>'required|exists:products,id',
        ]);

        $vendorProduct = VendorProduct::create($request->all());

        return new VendorProductResource($vendorProduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function show(VendorProduct $vendorProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    // public function edit(VendorProduct $vendorProduct)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorProduct $vendorProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $vendorProduct = VendorProduct::find($id);
       $vendorProduct->delete();

       return response()->noContent();

    }
}
