<?php

namespace Tests\Feature\Administrator\Payment\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return Void
     */
    public function testarrayProducts(): Void
    {
        $this->assertContains('xs', ['vestido', 'xs', 'blue']);
    }
}
