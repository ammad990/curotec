<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderBy('id','desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $task = Task::create($request->all());
            return [
                "status" => true,
                "task" => $task
            ];
        }
        catch(\Exception $ex){
            return response()->json([
                'message'=>$ex->getMessage(),
                'success'=>false
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Task::find($id);
        if (!$post) {
            return response()->json([
                "status" => false,
                "message" => "Task not found"
            ])->setStatusCode(404);
        }

        return $post;
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
    public function update(Request $request, $id)
    {
        //
        $task = Task::find($id);
        if(!empty($task)){

            try{
                $task->status = $request->get('status');
                $task->save();
                return [
                    "status" => true,
                    "task" => $task
                ];
               
            }
            catch(\Exception $ex){
                return response()->json([
                    'message'=>$ex->getMessage(),
                    'success'=>false
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $task = Task::find($id);
            if($task){
                $task->delete();
                return [
                    "status" => true
                ];
            }
        }
        catch(\Exception $ex){
            return response()->json([
                'message'=>$ex->getMessage(),
                'success'=>false
            ]);
        }
    }
    
}
