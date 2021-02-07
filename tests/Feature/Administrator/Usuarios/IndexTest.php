<?php

namespace Tests\Feature\Administrator\Usuarios;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('vitrina');

        $response->assertStatus(200);
    }

    public function testSizesNotAuthorizeTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('sizes');

        $response->assertStatus(403);
    }

    public function testColorsNotAuthorizeTest()
    {
        $this->withoutMiddleware();
        $response = $this->get('colors');

        $response->assertStatus(403);
    }

    public function testCategoriesNotAuthorizeTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('categories');

        $response->assertStatus(403);
    }

    public function testWeNotAuthorizeTest(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('nosotros');

        $response->assertStatus(200);
    }

    public function testRolTestNotAuthorize(): void
    {
        $this->withoutMiddleware();
        $response = $this->get('roles');

        $response->assertStatus(403);
    }
}
