<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\TransactionClasses;

/**
 * This php file contains an abstract class
 * where all necessary fields are available for make transaction
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01
 */

abstract class PayingConsumer extends ShippingInfo{
    /** Full name of the paying consumer */
    public string $customer_name;
    public string $customer_phone;
    public string $customer_email;
    public string $customer_address;
    public string $customer_city;
    public string $customer_state;
    public string $customer_postcode;
    public string $customer_country;
}
