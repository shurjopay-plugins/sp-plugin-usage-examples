//
//  ExecuteUrlData.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-23
//

import Foundation

struct ExecuteUrlData: Codable {
    public var token: String
    public var storeId: Int
    public var prefix: String
    public var currency: String
    public var amount: Double
    public var orderId: String
    //
    public var discsountAmount: Double
    public var discPercent: Double
    public var clientIp: String
    public var customerName: String
    public var customerPhone: String
    //
    public var customerEmail: String
    public var customerAddress: String
    public var customerCity: String
    public var customerState: String
    public var customerPostcode: String
    //
    public var customerCountry: String
    public var returnUrl: String
    public var cancelUrl: String
    public var value1: String
    public var value2: String
    public var value3: String
    public var value4: String
    
    enum CodingKeys: String, CodingKey {
        case token = "token"
        case storeId = "store_id"
        case prefix = "prefix"
        case currency = "currency"
        case amount = "amount"
        case orderId = "order_id"
        //
        case discsountAmount = "discsount_amount"
        case discPercent = "disc_percent"
        case clientIp = "client_ip"
        case customerName = "customer_name"
        case customerPhone = "customer_phone"
        //
        case customerEmail = "customer_email"
        case customerAddress = "customer_address"
        case customerCity = "customer_city"
        case customerState = "customer_state"
        case customerPostcode = "customer_postcode"
        case customerCountry = "customer_country"
        //
        case returnUrl = "return_url"
        case cancelUrl = "cancel_url"
        case value1 = "value1"
        case value2 = "value2"
        case value3 = "value3"
        case value4 = "value4"
    }
}
