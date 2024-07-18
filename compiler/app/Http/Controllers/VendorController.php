<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Resources\VendorResource;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UPdateVendorRequest;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::with('Products','department')->get();
        return new VendorResource($vendors);
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
    public function store(StoreVendorRequest $request)
    {
        $vendor_logo = '';
        if($request->hasFile('logo')){
            $vendor_logo = Vendor::saveImage($request->logo,'vendors');
         $request->logo = $vendor_logo ;
        }


        $vendor = Vendor::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'note'=>$request->note,
            'logo'=>$request->logo,
            'department_id'=>$request->department_id,
        ]);

        return new VendorResource($vendor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $vendor = Vendor::find($id);
       return new VEndorResource($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest  $request, $id)
    {
        $vendor = Vendor::find($id);
       $vendor->update($request->all());
       return new VendorResource($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $vendor = Vendor::find($id);
       $vendor->delete();
       return response()->noContent();
    }
}
