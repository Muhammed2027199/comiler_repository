<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\ManagerResource;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::with('malls')->get();
        return new ManagerResource($managers);
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
         $manager_photo = '';
         if($request->hasFile('photo')){
            $manager_photo = Manager::saveImage($request->photo,'managers');
          $request->photo = $manager_photo ;
         }

        $validate = $request->validate([
            'name' => 'required|max:255',
            'email'=>'required|email',
            'phone' =>'required|unique:managers,phone',
            'password'=>'required|min:4|max:15',

        ]);

        $manager = Manager::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'photo'=>$request->photo,
            'password'=>$request->password,
            'phone'=>$request->phone,
            'gender'=>$request->gender,

        ]);

        return new ManagerResource($manager) ;



    }

    // public static function saveImage($photo,$folder)
    // {
    //    $photo->store('/',$folder);
    //    $filename = $photo->hashName();
    // //    $path = 'images/'.$folder.'/'.$filename;
    //    return $filename;

    // }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    //    return response()->noContent();

    public function show($id)
    {
        $manager = Manager::with('malls')->find($id);
        return new ManagerResource($manager);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    // public function edit(Manager $manager)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        // $manager_photo = '';
        // if($request->hasFile('photo')){
        //    $manager_photo = Manager::saveImage($request->photo,'managers');
        //  $request->photo = $manager_photo ;
        // }

       $validate = $request->validate([
           'name' => 'sometimes|required|max:255',
           'email'=>'sometimes|required|email',
           'phone' =>'sometimes|required|unique:managers,phone',
           'password'=>'sometimes|required|min:4|max:15',

       ]);

        $manager->update($validate);

        return new ManagerResource($manager);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        // $manager->malls()->delete();
        $manager->delete();
        return response()->noContent();
    }
}
