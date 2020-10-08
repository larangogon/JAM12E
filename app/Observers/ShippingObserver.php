<?php

namespace App\Observers;

class ShippingObserver
{
    public function created($shipping)
    {
        logger()->info(
            'se ha registrado un nuevo recipient_shipping',
            [
                'name_recipient' => $shipping->name_recipient,
                'city_recipient' => $shipping->city_recipient,
                'country_recipient' => $shipping->country_recipient,
                'phone_recipient' => $shipping->phone_recipient,
                'cellphone_recipient' => $shipping->cellphone_recipient,
                'address_recipient' => $shipping->address_recipient]
        );
    }

    public function updated($shipping)
    {
        logger()->info(
            'se ha editado recipient_shipping',
            [
                'name_recipient' => $shipping->name_recipient,
                'city_recipient' => $shipping->city_recipient
            ]
        );
    }
}
