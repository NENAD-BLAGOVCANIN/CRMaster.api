<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskAssignee;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::with('assignees')->orderBy('id', 'desc')->get();
        return response()->json($tasks);
    }

    public function getSubmoduleTasks(Request $request, $submodule_id){
        $tasks = Task::with('assignees')->where('submodule_id', '=', $submodule_id)->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|string',
            'submodule_id' => 'nullable|exists:submodules,id',
        ]);

        $task = Task::create($validatedData);
        $task->status = Task::STATUS_TODO;
        $task->save();

        return response()->json($task, 201);
    }

    public function toggleAssignee(Request $request){

        $user_id = $request->get('user_id');
        $task_id = $request->get('task_id');

        $existingAssignee = TaskAssignee::where("user_id", '=', $user_id)->where("task_id", "=", $task_id)->first();
        if($existingAssignee){
            $existingAssignee->delete();
        }else{
            $task_assignee = new TaskAssignee();
            $task_assignee->task_id = $task_id;
            $task_assignee->user_id = $user_id;
            $task_assignee->save();
        }

        $updatedTask = Task::with('assignee')->findOrFail($task_id);

        return response()->json($updatedTask, 201);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'due_date' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validatedData);

        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
