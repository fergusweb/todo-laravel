<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_it_loads_the_about_page(): void
    {
        //$view = $this->view('about', ['heading' => 'About']);
        //$view->assertSee('About');
        $this->get('/about')->assertSee('About');
    }
}
