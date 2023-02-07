//
//  RequestData.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

struct CheckoutData: Codable {
    public var checkoutUrl:         String?
    public var amount:              Double?
    public var currency:            String?
    public var spOrderId:           String?
    public var customerOrderId:     String?
    public var customerName:        String?
    public var customerAddress:     String?
    public var customerCity:        String?
    public var customerPhone:       String?
    public var customerEmail:       String?
    public var clientIp:            String?
    public var intent:              String?
    public var transactionStatus:   String?
    
    enum CodingKeys: String, CodingKey {
        case checkoutUrl = "checkout_url"
        case amount = "amount"
        case currency = "currency"
        case spOrderId = "sp_order_id"
        case customerOrderId = "customer_order_id"
        //
        case customerName = "customer_name"
        case customerAddress = "customer_address"
        case customerCity = "customer_city"
        case customerPhone = "customer_phone"
        case customerEmail = "customer_email"
        case clientIp = "client_ip"
        //
        case intent = "intent"
        case transactionStatus = "transactionStatus"
    }
}
/*public struct CheckoutData {
    public var token:               String
    public var storeId:             Int
    public var prefix:              String
    public var currency:            String
    public var returnUrl:           String
    public var cancelUrl:           String
    public var amount:              Double
    public var orderId:             String
    public var discsountAmount:     Double
    public var discPercent:         Double
    public var clientIp:            String
    public var customerName:        String
    public var customerPhone:       String
    public var customerEmail:       String
    public var customerAddress:     String
    public var customerCity:        String
    public var customerState:       String
    public var customerPostcode:    String
    public var customerCountry:     String
    public var value1:              String
    public var value2:              String
    public var value3:              String
    public var value4:              String
}*/
