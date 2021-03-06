<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutApiTest extends TestCase
{

    use RefreshDatabase;

    public function setUp() : void
    {

      parent::setUp();

      // テストユーザ作成
      $this->user = factory(User::class)->create();

    }

    public function should_認証済のユーザをログアウト(){
      $response = $this->actingAs($this->user)
                       ->json('POST', route('logout'));

      $response->assertStatus(200);
      $this->assertGuest();
    }
}
