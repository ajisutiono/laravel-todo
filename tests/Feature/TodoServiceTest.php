<?php

namespace Tests\Feature;

use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class TodoServiceTest extends TestCase
{
    private TodoService $todoService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete("DELETE from todos");

        $this->todoService = $this->app->make(TodoService::class);
    }

    public function testTodoServiceNotNull()
    {
        self::assertNotNull($this->todoService);
    }

    public function testSaveTodo()
    {
        $this->todoService->saveTodo("1", "Todo 1");

        $todos = $this->todoService->getTodoList();
        foreach ($todos as $todo) {
            self::assertEquals("1", $todo["id"]);
            self::assertEquals("Todo 1", $todo["todo"]);
        }
    }

    public function testGetTodoEmpty()
    {
        self::assertEquals([], $this->todoService->getTodoList());
    }

    public function testGetTodoNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Todo 1"
            ],
            [
                "id" => "2",
                "todo" => "Todo 2"
            ]
        ];

        $this->todoService->saveTodo("1", "Todo 1");
        $this->todoService->saveTodo("2", "Todo 2");

        Assert::assertArraySubset($expected, $this->todoService->getTodoList());

    }

    public function testRemoveTodo()
    {
        $this->todoService->saveTodo("1", "Todo 1");
        $this->todoService->saveTodo("2", "Todo 2");

        self::assertEquals(2, sizeof($this->todoService->getTodoList()));

        $this->todoService->removeTodo("3");
        self::assertEquals(2, sizeof($this->todoService->getTodoList()));
        
        $this->todoService->removeTodo("2");
        self::assertEquals(1, sizeof($this->todoService->getTodoList()));

        $this->todoService->removeTodo("1");
        self::assertEquals(0, sizeof($this->todoService->getTodoList()));

    }
}
