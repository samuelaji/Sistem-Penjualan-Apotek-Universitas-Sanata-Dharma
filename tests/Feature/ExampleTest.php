<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_page_does_not_include_popup_scripts(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertDontSee('AppPopup');
        $response->assertDontSee('system-popups.js');
    }
}
