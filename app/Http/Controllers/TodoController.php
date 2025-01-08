<?php

namespace App\Http\Controllers;

use App\Models\Todo;
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

    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');

        if (empty($todo)) {
            $todoList = $this->todoService->getTodoList();
            return view('todo.todo', [
                'title' => 'Todolist',
                'todos' => $todoList,
                'error' => 'Todo is required'
            ]);
        }

        $this->todoService->saveTodo(random_int(1, 100), $todo);

        return redirect()->action([TodoController::class, 'todoList']);
    }

    public function removeTodo(Request $request, $todoId)
    {
        $this->todoService->removeTodo($todoId);
        return redirect()->action([TodoController::class, 'todoList']);
    }
}
