//
//  ApiInterface.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-17
//

import Foundation

class ApiInterface {
    var baseUrl: String = AppConstants.BASE_URL_SANDBOX;
    init(baseUrl: String) {
        self.baseUrl = baseUrl
    }
    func getToken() -> String {
        //return baseUrl + "get_token";
        return "\(baseUrl)get_token";
    }

    func checkout() -> String {
        //return baseUrl + "secret-pay";
        return "\(baseUrl)secret-pay";
    }

    func verify() -> String {
        //return baseUrl + "verification";
        return "\(baseUrl)verification";
    }
}
