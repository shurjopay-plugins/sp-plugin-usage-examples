<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

    /**
     * This trait provides a method for getting client's device ip address
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */

trait GetIpService{

    ################################################################################
                   # GetIpService Method
    ################################################################################

    /**
     * Prepare method for getting client ip address
     *
     * @param  void
     * @return string $ip
     */

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return client ip
    }
}
