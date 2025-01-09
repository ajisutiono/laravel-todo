<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE from todos");
    }

    public function testGetTodoList()
    {
        $this->seed(TodoSeeder::class);

        $this->withSession([
            "email" => "admin@mail.com"
        ])->get("/todo")
            ->assertSeeText("1")
            ->assertSeeText("Todo 1")
            ->assertSeeText("2")
            ->assertSeeText("Todo 2");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "email" => "admin@mail.com"
        ])->post('/todo')
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "email" => "admin@mail.com"
        ])->post('/todo', [
            "todo" => "Todo 3"
        ])->assertRedirect('/todo');
    }

    public function testRemoveTodo()
    {
        $this->withSession([
            "email" => "admin@mail.com",
            "todo" => [
                [
                    "id" => "1",
                    "todo" => "Todo 1"
                ],
                [
                    "id" => "2",
                    "todo" => "Todo 2"
                ]
            ]
        ])->post('/todo/2/delete')
            ->assertRedirect('/todo');
    }
}
