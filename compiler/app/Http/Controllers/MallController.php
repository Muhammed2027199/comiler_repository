<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use Illuminate\Http\Request;
use App\Http\Resources\MallResource;
use App\Http\Requests\UpdateMallRequest;
use App\Http\Requests\StoreMallRequest;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $malls = Mall::all();
        return new MallResource($malls);
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
     * @return \Illuminate\Http\Respons e
     */
    public function store(StoreMallRequest $request)
    {
        $manager_photo = '';
         if($request->hasFile('photo')){
            $manager_photo = Mall::saveImage($request->photo,'malls');
          $request->photo = $manager_photo ;
         }

        // $validated = $request->validate([
        //     'name'=>'required|max:255',
        //     'address'=>'required|max:255',
        //     'phone'=>'required|max:255',
        //     'manager_id'=>'required|exists:managers,id',
        // ]);

        $mall = Mall::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'note'=>$request->note,
            'photo'=>$request->photo,
            'manager_id'=>$request->manager_id,
        ]);

        return new MallResource($mall);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mall = Mall::with('manager','departments')->find($id);
        return new MallResource($mall);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    // public function edit(Mall $mall)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMallRequest $request, $id)
    {
        $mall = Mall::find($id);


        // $validated = $request->validate([
        //     'name'=>'sometimes|required|max:255',
        //     'address'=>'sometimes|required|max:255',
        //     'phone'=>'sometimes|required|max:255',
        //     'manager_id'=>'sometimes|required|exists:managers,id',
        // ]);

        $mall->update($request->all());

        return new MallResource($mall);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mall $mall)
    {
        if(!$mall){
            return 'no mall in this id';
        }
        $mall->delete();
        return response()->noContent();
    }
}
