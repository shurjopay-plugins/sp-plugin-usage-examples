<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

    /**
     * This trait provides a method for making custom exception message and it's format
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */

trait ExceptionInfoService{

    ################################################################################
                   # ExceptionInfoService Method
    ################################################################################

    /**
     * Prepare exceptionInfo method for making a format of our Shurjopay Exception' Response
     *
     * @param  string $exception
     * @return void
     */

    public function exceptionInfo($message,$e){

        $laravel_error_msg = $e->getMessage();
        $shurjopay_help=$message;
        $problem_file_name = $e->getFile();
        $problem_LineNumber= $e->getLine();
        $myResponse=["laravel_error_msg" => $laravel_error_msg,"shurjopay_help"=>$shurjopay_help, "problem_file_name" => $problem_file_name,"problem_LineNumber"=>$problem_LineNumber];

        foreach($myResponse as $attribute=>$value){
            echo $attribute."=>".$value."<br>";
        }
        exit;

    }
}
