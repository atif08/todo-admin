<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Mocono\RequestValidate\User\UserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users']=User::where('type',2)->get();
        $data['code']=200;
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
    public function store(Request $request, UserRequest $userRequest)
    {
        if(isset(request()->user_id) && !empty(request()->user_id)){
            $user=User::where('id',request()->user_id)->first();
            $user->update($userRequest->prepareRequest());
            $message="User updated successfully";
        }else{
            $user= User::create($userRequest->prepareRequest());
            if($user){
                $user->assignRole('user');
            }
            $message="User created successfully";
        }

        $data['message']=$message;
        $data['code']=201;
        return  response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= User::where('id',$id)->first();
        return  response()->json($data);
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
    public function update(Request $request, $id, UserRequest $userRequest)
    {
        if($user=User::where('id',$id)->first()){
            $user->update($userRequest->prepareRequest());
            $message="User created successfully";
        }else{
            $message="Not found";
        }
        $data['message']=$message;
        $data['code']=201;
        return  response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($user=User::where('id',$id)->first()){
           $delete= $user->delete();
            return  response()->json($delete,200);
        }

    }
}
