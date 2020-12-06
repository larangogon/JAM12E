<?php

namespace Tests\Feature\Administrator\Payment\Order;

use Tests\TestCase;

class ReturnLoginOrdersTest extends TestCase
{
    public function testViewCeateOrdersLogin(): void
    {
        $this->get(route('orders.create'))
            ->assertRedirect(route('login'));
    }

    public function testViewIndexOrdersLogin(): void
    {
        $this->get(route('orders.index'))
            ->assertRedirect(route('login'));
    }
}
