<?php

namespace App\Observers;

class ShippingObserver
{
    /**
     * @param $shipping
     */
    public function created($shipping)
    {
        logger()->channel('stack')->info(
            'se ha registrado un nuevo recipient_shipping',
            [
                'name_recipient'      => $shipping->name_recipient,
                'city_recipient'      => $shipping->city_recipient,
                'country_recipient'   => $shipping->country_recipient,
                'phone_recipient'     => $shipping->phone_recipient,
                'cellphone_recipient' => $shipping->cellphone_recipient,
                'address_recipient'   => $shipping->address_recipient]
        );
    }

    /**
     * @param $shipping
     */
    public function updated($shipping)
    {
        logger()->channel('stack')->info(
            'se ha editado recipient_shipping',
            [
                'name_recipient' => $shipping->name_recipient,
                'city_recipient' => $shipping->city_recipient
            ]
        );
    }
}
