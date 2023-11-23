<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\TaskUser;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        $response = [
            'response' => [
                'success' => true,
                'tasks' => [
                    'data' => $tasks,
                ]
            ]
        ];
        return response()->json($response, 200);
    }

    public function currentTask(Request $request)
    {
        $projectId = $request->input('project_id');

        if($request -> id_task){
            $tasks = Task::with('comments.comment.user.avatar')
                ->with('informationTask.user')
                ->with('description')->with('photo')
                ->where('id', $request -> id_task)
                ->first();
        } else {
            $tasks = Task::with('comments.comment.user.avatar')
                ->with('informationTask.user')
                ->with('user.avatar')
                ->with('description')->with('photo')
                ->where('project_id', $projectId)
                ->get();
        }


        $response = [
            'response' => [
                'success' => true,
                'tasks' => [
                    'data' => $tasks,
                ]
            ]
        ];

        return response()->json($response, 200);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request -> deleteId){
            $result = Task::find($request -> deleteId);
            if($result){
                $result -> delete();
                $message = 'delete task';
                return response()->json($message, 200);
            } else {
                $message = 'no tasks';
                return response()->json($message,200);
            }
        }
        if($request -> id){
            $task = Task::find($request -> id);
            $task -> name = $request -> name;
            $task -> user_id = $request -> user_id;
            $task -> status_id = $request -> status_id;
            $task -> save();
            if($task){
                $response = [
                    'response' => [
                        'success' => true,
                        'task' => [
                            'data' => $task,
                        ]
                    ]
                ];
                return response()->json($response, 200);
            } else {
                $message = 'no task';
                return response()->json($message, 200);
            }
        } else{
            $task = Task::create([
                'name' => $request -> name,
                'user_id' => $request -> user_id,
                'status_id' => $request -> status_id,
                'project_id' => $request -> project_id
            ]);
//            TaskUser::create([
//                'user_id' => $request -> user_id,
//            ]);
            $response = [
                'response' => [
                    'success' => true,
                    'task' => [
                        'data' => $task,
                    ]
                ]
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
