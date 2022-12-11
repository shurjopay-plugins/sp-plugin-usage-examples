<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\ShurjopayException;

use Exception;
use Throwable;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\ServiceMethod;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\ExceptionInfoService;

/**
 * This php file contains a custom exception class
 * Here , a constructor is used for get throwing string , exception instance and others
 * Inside that constructor customFunction() and exceptionInfo() called
 * Here exceptionInfo() method used from ExceptionInfoService trait
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01
 */

 class ShurjopayException extends Exception
 {

    use ExceptionInfoService;

  // Redefine the exception so message isn't optional
  public function __construct($message, $code = 0,$e=null, Throwable $previous = null) {
    // some code
    //dd(get_class($e));
    $this->customFunction();
    $this->exceptionInfo($message,$e);
    // make sure everything is assigned properly
    parent::__construct($message, $code, $previous);

}

// This is a method which prints a default exception for every custom exception message.
public function customFunction() {
    echo "<u> <br> <h3> A ShurjoPay Message For This Type Of Exception :- </h3>  </u>";
}

}
