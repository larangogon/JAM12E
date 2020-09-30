<?php

namespace Tests\Feature\Administrator\Payment\Order;

use Tests\TestCase;

class ReturnLoginOrdersTest extends TestCase
{
    public function testViewCeateOrders_login(): void
    {
        $this->get(route('orders.create'))
            ->assertRedirect(route('login'));
    }

    public function testViewIndexOrders_login(): void
    {
        $this->get(route('orders.index'))
            ->assertRedirect(route('login'));
    }

    public function testViewStatusOrderslogin(): void
    {
        $this->get(route('orders.status'))
            ->assertRedirect(route('login'));
    }
}
