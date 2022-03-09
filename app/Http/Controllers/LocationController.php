<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Mocono\RequestValidate\Location\LocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['locations']=Location::where('user_id',auth()->user()->id)->skip(1)->take(100)->orderBy('id','DESC')->get();

        return  response()->json($data,200);
    }
    public function userLocations($id)
    {
        $data['locations']=Location::where('user_id',$id)->skip(1)->take(100)->orderBy('id','DESC')->get();

        return  response()->json($data,200);
    }
    public function currentLocation()
    {
        $data=Location::where('user_id',auth()->user()->id)->orderBy('id','DESC')->first();

        return  response()->json($data);
    }
    public function userCurrentLocation($id)
    {
        $data=Location::where('user_id',$id)->orderBy('id','DESC')->first();

        return  response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,LocationRequest $locationRequest)
    {
         $data= Location::create($locationRequest->prepareRequest());
        $data['message']="Check-in created successfully";
        $data['code']=201;
        return  response()->json($data,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Location::where('id',$id)->first();
        return  response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,LocationRequest $locationRequest)
    {
        $location=Location::where('id',$id)->first();
        $location->update($locationRequest->prepareRequest());
        return  response()->json($location,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($location=Location::where('id',$id)->first()){
            $delete= $location->delete();
            return  response()->json($delete,200);
        }

    }
}
