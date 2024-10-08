<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index(TodoList $todo_list){
        $tasks=$todo_list->tasks;
        return response($tasks);
    }

    public function store(Request $request,TodoList $todo_List){

        return $todo_List->tasks()->create([$request->all()]);
    }

    public function destroy(Task $task){
        $task->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }
    public function update(Task $task,Request $request){
        $task->update($request->all());
        return $task;
    }
}
