<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDataBase;

    public function test_fetch_tasks_of_a_todo_list()
    {
        $list=$this->createToDoList();
        $list2=$this->createToDoList();
        $task=$this->createTask(['todo_list_id'=>$list->id]);
        $this->createTask(['todo_list_id'=>$list2->id]);
        $response=$this->getJson(route('todo-list.task.index',$list->id))->assertOk()->json();

        $this->assertEquals(1,count($response));
        $this->assertEquals($task->title,$response[0]['title']);
        $this->assertEquals($response[0]['todo_list_id'],$list->id);
    }

    public function test_store_a_task_for_a_todo_list()
    {
        $list=$this->createToDoList();
        $task=Task::factory()->make();

        $this->postJson(route('todo-list.task.store', $list->id), ['title' => $task->title])
            ->assertCreated();

        $this->assertDatabaseHas('tasks', ['title' => $task->title,
            'todo_list_id' => $list->id]);

    }

    public function test_delete_a_task_from_database()
    {
        $task=$this->createTask();

        $this->deleteJson(route('task.destroy',$task->id))->assertNoContent();

        $this->assertDatabaseMissing('tasks',['title'=>$task->title]);
    }

    public function test_update_a_task_from_database(){
        $task = $this->createTask();

        $this->patchJson(route('task.update',$task->id),['title'=>'updated title'])
        ->assertOk();

        $this->assertDataBaseHas('tasks',['title'=>'updated title']);

    }

}
