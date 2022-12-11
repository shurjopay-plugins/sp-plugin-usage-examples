<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\TransactionClasses;

/**
 * This php file contains an abstract class
 * where all necessary fields are available for make transaction and these are related with shipping info
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01
 */

abstract class ShippingInfo{
    /** Full name of the shipping consumer */
    public string $shipping_address;
    public string $shipping_city;
    public string $shipping_country;
    public string $received_person_name;
    public string $shipping_phone_number;
}
