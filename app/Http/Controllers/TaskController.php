<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Mocono\RequestValidate\Task\TaskRequest;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks']=Task::where('user_id',auth()->user()->id)->get();
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
    public function store(Request $request, TaskRequest $taskRequest)
    {
         Task::create($taskRequest->prepareRequest());
        $data['message']="Task created successfully";
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
        $data= Task::where('id',$id)->first();
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
    public function update(Request $request, $id, TaskRequest $taskRequest)
    {
        if($task=Task::where('id',$id)->first()){
            $task->update($taskRequest->prepareRequest());
            $message="Task created successfully";
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
        if($task=Task::where('id',$id)->first()){
           $delete= $task->delete();
            return  response()->json($delete,200);
        }

    }
}
