<?php

namespace Tests;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp():void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

    }

    public function createToDoList($arg=[])
    {
        return TodoList::factory()->create($arg);

    }
    public function createTask($arg=[])
    {
        return Task::factory()->create($arg);

    }
}
