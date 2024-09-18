<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function Laravel\Prompts\warning;

class ToDoListTest extends TestCase
{
use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function setUp(): void
    {
        parent::setUp();
        $this->list=$this->createToDoList(['name'=>'my list']);
    }

    public function test_fetch_all_Todo_list()
    {
        $response = $this->getJson(route('todo-list.index'))->json();
        $this->assertEquals(1,count($response));
        $this->assertEquals('my list',$response[0]['name']);
    }

    public function test_fetch_single_Todo_list()
    {
        $response=$this->getJson(route('todo-list.show',$this->list->id))
        ->assertOk()
        ->json();
        $this->assertEquals($response['name'],$this->list->name);

    }

    public function test_store_new_todo_list()
    {
        $list=TodoList::factory()->make();
        $response=$this->postJson(route('todo-list.store'),[
            'name'=>$list->name])
            ->assertCreated()
            ->json();
        $this->assertEquals($list->name,$response['name']);
        $this->assertDatabaseHas('todo_lists',['name'=>$list->name]);
    }

    public function test_delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy',$this->list->id))
            ->assertNoContent();
        $this->assertDatabaseMissing('todo_lists',[
            'name'=>$this->list->name]);
    }
    public function test_update_todo_list()
    {
        $this->patchJson(route('todo-list.update',$this->list->id),['name'=>'updated name'])
            ->assertOk();
        $this->assertDatabaseHas('todo_lists',['id'=>$this->list->id,'name'=>'updated name']);
    }
//    public function test_store_with_missing_fields(){
//
//        $this->withoutExceptionHandling();
//
//         $this->postJson(route('todo-list.store'))
//        ->assertUnprocessable()
//        ->assertJsonValidationErrors(['name']);
//    }
//    public function test_update_with_missing_fields(){
//        $this->withoutExceptionHandling();
//
//        $this->patchJson(route('todo-list.update'),$this->list->id)
//            ->assertUnprocessable()
//            ->assertJsonValidationErrors('name');
//    }

    public function test_if_todo_list_is_deleted_then_its_tasks_will_be_deleted(){

        $list=$this->createToDoList();
        $task=$this->createTask(['todo_list_id'=>$list->id]);
        $task2=$this->createTask();

        $list->delete();

        $this->assertDatabaseMissing('todo_lists',['id'=>$list->id]);
        $this->assertDatabaseMissing('tasks',['id'=>$task->id]);
        $this->assertDatabaseHas('tasks',['id'=>$task2->id]);
    }
}
