<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class AuthTest extends TestCase
{

    use DatabaseTransactions;

    public function test_a_user_may_register_and_login()
    {
        $response = $this->call('POST', '/register', [
                'name' => 'JohnSnow',
                'username' => 'john_snow',
                'password' => 'password',
        ]);
        $this->assertEquals(302, $response->status());
        $this->seeInDatabase('users', [
            'name' => 'JohnSnow',
            'username' => 'john_snow',
        ]);
    }

    // letters, numbers and underscores only
    public function test_a_user_can_use_only_valid_username()
    {
        $response = $this->call('POST', '/register', [
                'name' => 'JohnSnow',
                'username' => 'john.snow',
                'password' => 'password',
        ]);
        // $this->assertEquals(409, $response->status());
        $this->dontSeeInDatabase('users', ['name' => 'JohnSnow']);
    }

    protected function login($user = null)
    {
        $user = $user ?: factory(App\User::class)->create([
            'password' => bcrypt('password'),
            'username' => 'this_is_a_test_username'
        ]);

        $response = $this->call('POST', '/login', [
            'username' =>'this_is_a_test_username',
            'password' => 'password'
        ]);

        $this->assertEquals(302, $response->status());
    }

    public function test_a_user_may_login()
    {
        $this->login();
    }
}
