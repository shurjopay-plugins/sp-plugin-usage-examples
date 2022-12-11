<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

use Illuminate\Support\Facades\Validator;

    /**
     * This trait provides a method for validating requested fields
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */

trait ValidationService{

    ################################################################################
                   # ValidationService Method
    ################################################################################

     /**
     * Validate a transaction request required data
     *
     * @param  mixed $request
     * @return void
     */

    public function validateInput($request)
    {
        $validate_input = Validator::make((array)$request,
            array(
                'order_id' => "required|string",
                'amount' => "required",
                'customer_name' => "required|max:200",
                'customer_phone' => "required|regex:/(01)[0-9]{9}/|max:18",
                'customer_address' => "required|max:250",
                'customer_city' => "required|max:15",
                'currency' => "required",
            )
        );

        # If validation fails show appropriate errors
        if ($validate_input->fails()) {
            $errors = $validate_input->errors();

            $error_array = array();
            foreach ($errors->all() as $error){
                $e = $error;
                array_push($error_array,$e);
            }

            return array(
                'isValidationPass' => false,
                'message' => "Validation Failed",
                'errors' => array($error_array)
            );
        }

        # When validation passed
        else{
            return array(
                'isValidationPass' => true,
                'message' => "Validation success",
            );
        }

    }
}
