<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE from users");

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSucces()
    {
        $this->seed(DatabaseSeeder::class);

        self::assertTrue($this->userService->login("admin@mail.com", "rahasia"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("salah", "salah"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("aji", "salah"));
    }
}
