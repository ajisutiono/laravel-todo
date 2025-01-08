<?php

namespace App\Services;

interface TodoService 
{
    public function saveTodo($id, $name): void;

    public function getTodoList(): array;

    public function removeTodo($todoId);
}