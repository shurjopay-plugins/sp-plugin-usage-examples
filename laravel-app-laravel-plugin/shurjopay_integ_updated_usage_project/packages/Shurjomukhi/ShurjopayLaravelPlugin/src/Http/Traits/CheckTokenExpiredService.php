<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

use Shurjomukhi\ShurjopayLaravelPlugin\Http\ShurjopayException\ShurjopayException;

    /**
     * This trait provides a method for checking token expiration
     * Token will be valid from token created time to next 30seconds
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-06
     */
trait CheckTokenExpiredService{

    ################################################################################
                   # CheckTokenExpiredService Method
    ################################################################################

    /**
     * Prepare a method for checking token expiration
     *
     * @param string $token_create_time
     * @return bool
     */

    public function CheckTokenExpired($token_create_time)
    {
            // Setting time zone
            date_default_timezone_set('Asia/Dhaka');
            // Adding 30 seconds with token created time
            $token_additional_time = date('h:i:sa', strtotime($token_create_time. ' +30 seconds'));
            // Taking current time
            $current_time = date('h:i:sa');

            /* if $token_additional_time > $current_time then token will be
               valid and true will be returned otherwise false will be returned
            */
            if( $token_additional_time > $current_time ){
                return true;
            }else{
                return false;
            }

    }

}
