<?php

namespace Tests\Feature\Administrator\Payment\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function testArrayProducts(): void
    {
        $this->assertContains('xs', [
            'vestido', 'xs', 'blue'
        ]);
    }
}
