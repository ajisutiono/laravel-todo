<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from users");
    }

    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }
}
