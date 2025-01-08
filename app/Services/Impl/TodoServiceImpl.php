<?php

namespace App\Services\Impl;

use App\Models\Todo;
use App\Services\TodoService;

class TodoServiceImpl implements TodoService
{
    public function saveTodo($id, $name): void
    {
        $todo = new Todo([
            "id" => $id,
            "name" => $name
        ]);
        $todo->save();
    }

    public function getTodoList(): array
    {
        return Todo::query()->get()->toArray();
    }

    public function removeTodo($todoId)
    {
        $todo = Todo::query()->find($todoId);
        if ($todo != null) {
            $todo->delete();
        }
    }
}
