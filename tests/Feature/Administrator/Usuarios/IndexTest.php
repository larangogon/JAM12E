<?php

namespace Tests\Feature\Administrator\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testVitrinaTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('vitrina');

        $response->assertStatus(200);
    }

    public function testSizesTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('sizes');

        $response->assertStatus(200);
    }

    public function testColorsTest()
    {
        $this->withoutMiddleware();
        $response = $this->get('colors');

        $response->assertStatus(200);
    }

    public function testCategoriesTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('categories');

        $response->assertStatus(200);
    }

    public function testNosotrosTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('nosotros');

        $response->assertStatus(200);
    }

    public function testRolTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('roles');

        $response->assertStatus(200);
    }
}
