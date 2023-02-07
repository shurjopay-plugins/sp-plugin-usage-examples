//
//  AlertService.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-16
//

import Foundation

public class AlertService {
    public init() {}
    //func alert(message: String, title: String = "")
    public func alert(viewController: UIViewController, message: String) {
        let alertController = UIAlertController(title: "Alert", message: message, preferredStyle: .alert)
        let OKAction = UIAlertAction(title: "OK", style: .default, handler: nil)
        alertController.addAction(OKAction)
        viewController.present(alertController, animated: true, completion: nil)
    }
}
