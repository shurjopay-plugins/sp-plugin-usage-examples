//
//  ViewController.swift
//  ios-app-swift-package
//
//  Created by Shajedul Islam on 8/3/23.
//

import UIKit
import ShurjoPay

class ViewController: UIViewController {
    
    let shurjopay : Shurjopay = Shurjopay()
    var spOrderID: String?

    @IBAction func pay(_ sender: UIButton) {
        let requestModel : ShurjopayRequestModel = ShurjopayRequestModel(
            configs: ShurjopayConfigs(
                environment: "sandbox",
                userName: "sp_sandbox",
                password: "pyyk97hu&6u6",
                prefix: "sp",
                clientIP: "127.0.0.1"
            ),
            orderID: "sp1ab2c3d5",
            currency: "BDT",
            amount: 20,
            discountAmount: 0,
            discountPercentage: 0,
            customerName: "Shajedul Islam",
            customerPhoneNumber: "01628734916",
            customerAddress: "30/4 Darus Salam Road",
            customerCity: "Dhaka",
            customerPostcode: "1216",
            returnURL: "https://www.sandbox.shurjopayment.com/return_url",
            cancelURL: "https://www.sandbox.shurjopayment.com/cancel_url"
        )
        
        
        shurjopay.makePayment(parentUIViewController: self,  shurjopayRequestModel: requestModel){ shurjopayResponse in
            if(shurjopayResponse.status == true && shurjopayResponse.shurjopayOrderID != nil)
            {
                self.spOrderID = shurjopayResponse.shurjopayOrderID!
                return
            }
        }
    }
    @IBAction func verify(_ sender: UIButton) {
        if(spOrderID != nil)
        {
            shurjopay.verify(shurjopayOrderID: spOrderID!){ shurjopayVerificationModel in
                if(shurjopayVerificationModel.error != true && shurjopayVerificationModel.sp_code == "1000")
                {
                    DispatchQueue.main.async {
                        let dialogMessageVerSuccess = UIAlertController(title: "Success", message: "Your payment is verified.", preferredStyle: .alert)
                        let ok = UIAlertAction(title: "OK", style: .default)
                        dialogMessageVerSuccess.addAction(ok)
                        self.present(dialogMessageVerSuccess,animated: true,completion: nil)
                    }
                }
                else
                {
                   
                    DispatchQueue.main.async {
                        let dialogMessageVerFailed = UIAlertController(title: "Failed", message: "Payment verification failed.", preferredStyle: .alert)
                        let ok = UIAlertAction(title: "OK", style: .default)
                        dialogMessageVerFailed.addAction(ok)
                        self.present(dialogMessageVerFailed,animated: true,completion: nil)
                    }
                }
                return
                
            }
        }
        
    }

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
    }


}

