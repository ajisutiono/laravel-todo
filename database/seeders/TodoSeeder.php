<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::query()->insert([
            [
                "id" => "1",
                "todo" => "Todo 1"
            ],
            [
                "id" => "2",
                "todo" => "Todo 2"
            ]
        ]);
    }
}
