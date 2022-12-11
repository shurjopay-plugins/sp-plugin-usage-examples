<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

    /**
     * This trait provides a method for checking internet connection of client's device
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */
trait CheckInternetService{

    ################################################################################
                   # CheckNetworkConnection Method
    ################################################################################

    /**
     * Prepare a method for checking internet connection from client-side
     *
     * @return bool $is_conn
     */

    public function checkInternetConnection()
    {
        $connected = @fsockopen('www.google.com', 80);

        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }

}
