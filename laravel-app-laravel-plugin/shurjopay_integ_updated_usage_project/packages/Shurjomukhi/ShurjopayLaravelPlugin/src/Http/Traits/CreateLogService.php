<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

use Illuminate\Support\Facades\Log;

    /**
     * This trait provides a method for creating log of client's app.
     * This trait have createLog method for making log records according all laravel's version.
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */

trait CreateLogService{

    ################################################################################
                   # CreateLogService Method
    ################################################################################

    /**
     * Prepare Logging method for creating runtime 'shurjopay-plugin.log'
     * file in user's side with proper message
     *
     * @param  string $message
     * @return void
     */

    public function createLog( $message )
     {
      // dd(app()->version());
       if(app()->version()>=8){
            //this portion works for "laravel_version >= 8" only
            Log::build([
                'driver' => 'single',
                //'path' => storage_path('logs/shurjoPay-plugin.log'),
                'path' => config('Shurjopay.log_location1'),
                ])->info($message);

        }elseif((app()->version()< 8) && (app()->version() >= 5)){
            //this portion works for "8.0x < laravel_version > 5.0x"  only
            //Log::info($message);
            $this->sp_log("************** Time'" . gmdate('Y-m-d H:i:s.U \G\M\T') . "'**********");
            $this->sp_log($message);
        }else{
            //this portion works for "laravel_version < 5.0x" only
            $this->sp_log("************** Time'" . gmdate('Y-m-d H:i:s.U \G\M\T') . "'**********");
            $this->sp_log($message);
        }
     }

     public function sp_log($message)
     {
         /**-Function-sp_log
         This function is used to create log and make derectory if not exist.
         */
        if((app()->version()< 8) && (app()->version() >= 5)){

            $log_location = config('Shurjopay.log_location1');
            if (!file_exists($log_location)) mkdir($log_location, 0777, true);
            $log_file_data = $log_location;
            file_put_contents($log_file_data, $message . "\n", FILE_APPEND);

        }elseif((app()->version() < 5)){

            $log_location = config('Shurjopay.log_location2');
            if (!file_exists($log_location . 'shurjopay-plugin-log')) mkdir($log_location . 'shurjopay-plugin-log', 0777, true);
            $log_file_data = $log_location . 'shurjopay-plugin-log' . '/shurjoPay-plugin' . '.log';
            file_put_contents($log_file_data, $message . "\n", FILE_APPEND);
        }

     }
}
