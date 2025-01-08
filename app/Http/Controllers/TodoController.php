<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function todoList(Request $request)
    {
        $todoList = $this->todoService->getTodoList();

        return view('todo.todo', [
            'title' => 'Todolist',
            'todos' => $todoList
        ]);
    }
}
