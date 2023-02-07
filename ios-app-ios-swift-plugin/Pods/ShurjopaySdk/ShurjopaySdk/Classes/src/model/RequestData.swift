//
//  Request.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

public struct RequestData: Codable {
    public var username:            String?
    public var password:            String?
    public var prefix:              String?
    public var currency:            String?
    public var amount:              Double?
    public var orderId:             String?
    public var discountAmount:      Double?
    public var discPercent:         Double?
    //
    public var customerName:        String?
    public var customerPhone:       String?
    public var customerEmail:       String?
    public var customerAddress:     String?
    public var customerCity:        String?
    public var customerState:       String?
    public var customerPostcode:    String?
    public var customerCountry:     String?
    //
    public var returnUrl:           String?
    public var cancelUrl:           String?
    public var clientIp:            String?
    public var value1:              String?
    public var value2:              String?
    public var value3:              String?
    public var value4:              String?
    
    // Empty conostructor
    //public init() {}
    
    // Conostructor with value
    public init(
        username:           String?,
        password:           String?,
        prefix:             String?,
        currency:           String?,
        amount:             Double?,
        orderId:            String?,
        discountAmount:     Double?,
        discPercent:        Double?,
        //
        customerName:       String?,
        customerPhone:      String?,
        customerEmail:      String?,
        customerAddress:    String?,
        customerCity:       String?,
        customerState:      String?,
        customerPostcode:   String?,
        customerCountry:    String?,
        //
        returnUrl:          String?,
        cancelUrl:          String?,
        clientIp:           String?,
        value1:             String?,
        value2:             String?,
        value3:             String?,
        value4:             String?
    ) {
        self.username           = username
        self.password           = password
        self.prefix             = prefix
        self.currency           = currency
        self.amount             = amount
        self.orderId            = orderId
        self.discountAmount     = discountAmount
        self.discPercent        = discPercent
        //
        self.customerName       = customerName
        self.customerPhone      = customerPhone
        self.customerEmail      = customerEmail
        self.customerAddress    = customerAddress
        self.customerCity       = customerCity
        self.customerState      = customerState
        self.customerPostcode   = customerPostcode
        self.customerCountry    = customerCountry
        //
        self.returnUrl          = returnUrl
        self.cancelUrl          = cancelUrl
        self.clientIp           = clientIp
        self.value1             = value1
        self.value2             = value2
        self.value3             = value3
        self.value4             = value4
    }
}
internal struct RequestDataOld: Codable {
    public var username:            String? = nil
    public var password:            String? = nil
    public var prefix:              String? = nil
    public var currency:            String? = nil
    public var amount:              Double? = nil
    public var orderId:             String? = nil
    public var discountAmount:      Double? = nil
    public var discPercent:         Double? = nil
    public var customerName:        String? = nil
    public var customerPhone:       String? = nil
    public var customerEmail:       String? = nil
    public var customerAddress:     String? = nil
    public var customerCity:        String? = nil
    public var customerState:       String? = nil
    public var customerPostcode:    String? = nil
    public var customerCountry:     String? = nil
    public var returnUrl:           String? = nil
    public var cancelUrl:           String? = nil
    public var clientIp:            String? = nil
    public var value1:              String? = nil
    public var value2:              String? = nil
    public var value3:              String? = nil
    public var value4:              String? = nil
    public init() {}
    public init(username: String) {
        self.username = username
    }
}
