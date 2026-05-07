<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_redirects_to_login(): void
    {
        // Hit the home page
        $response = $this->get('/');

        // It should redirect us (302) because we are not logged in
        $response->assertStatus(302);
    }

    public function test_the_login_page_loads_successfully(): void
    {
        // The login page should be public and return a 200 OK
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}