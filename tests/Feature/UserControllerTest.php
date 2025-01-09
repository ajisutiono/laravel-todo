<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
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

    public function testLoginForMember()
    {
        $this->withSession([
            "email" => "admin@mail.com"
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $this->post('/login', [
            "email" => "admin@mail.com",
            "password" => "rahasia"
        ])->assertRedirect('/')
            ->assertSessionHas("email", "admin@mail.com");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "email" => "admin"
        ])->post('/login', [
            "email" => "admin",
            "password" => "rahasia"
        ])->assertRedirect('/');
    }

    public function testLoginEmpty()
    {
        $this->post('/login', [])
            ->assertSeeText('email or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "email" => "salah",
            "password" => "salah"
        ])->assertSeeText('email or password is wrong');
    }

    public function testLogout()
    {
        $this->withSession([
            "email" => "admin@mail.com"
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('email');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
