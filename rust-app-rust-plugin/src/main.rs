// #![allow(dead_code, unused_variables, non_snake_case, unused_imports, non_camel_case_types)]

use sp_plugin_rust_test::shurjopay::ShurjopayPlugin;
use std::io;

fn main() 
{
    // creating a new instance of Shurjopayplugin
    let mut sp_instance = ShurjopayPlugin::new();

    // set shurjopay configuration from .env file
    sp_instance.set_config_from_env_file();
    
    // make a payment request object
    let payment_req_obj = sp_instance.make_payment_request_object(
        "786".to_string(),
        "abc123".to_string(),
        "BDT".to_string(),
        "Mahmudul Islam".to_string(),
        "Dhaka".to_string(),
        "01811177722".to_string(),
        "Dhaka".to_string(),
        "1203".to_string(),
    );


    // pass payment request object to make_payment function to make payment
    if let Some(checkout_url) = sp_instance.make_payment(payment_req_obj) {
        println!("Opened '{}' successfully.", checkout_url.clone());

    }
    else {
        println!("An error occurred when opening url");
    }
     
    println!("\n\npress enter to verify payment");
    
    // Waiting to press enter            
    let mut guess = String::new();
    io::stdin()
        .read_line(&mut guess)
        .expect("Failed to read line");
        
    
    
   // verify payment using this function
    let response = sp_instance.verify_payment(sp_instance.get_order_id());
        print!("verify Payment Response: ");
        println!("{:?}",response);
    if response.is_some()
    {
        println!("\n\nsp_message: {:#?}", response.unwrap().clone().sp_message.unwrap());
    }
    
}


