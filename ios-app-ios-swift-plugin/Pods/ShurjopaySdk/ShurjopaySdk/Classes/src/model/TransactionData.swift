//
//  Transaction.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

public struct TransactionData: Codable {
    public var id:                  Int?
    public var orderId:             String?
    public var currency:            String?
    public var amount:              Double?
    public var payableAmount:       Double?
    public var discsountAmount:     Double?
    public var discPercent:         Double?
    public var usdAmt:              Double?
    public var usdRate:             Double?
    public var cardHolderName:      String?
    public var cardNumber:          String?
    public var phoneNo:             String?
    public var bankTrxId:           String?
    public var invoiceNo:           String?
    public var bankStatus:          String?
    public var customerOrderId:     String?
    public var spCode:              Int?
    public var spMassage:           String?
    public var name:                String?
    public var email:               String?
    public var address:             String?
    public var city:                String?
    public var transactionStatus:   String?
    public var dateTime:            String?
    public var method:              String?
    public var value1:              String?
    public var value2:              String?
    public var value3:              String?
    public var value4:              String?
    
    enum CodingKeys: String, CodingKey {
        case id                 = "id"
        case orderId            = "order_id"
        case currency           = "currency"
        case amount             = "amount"
        case payableAmount      = "payable_amount"
        case discsountAmount    = "discsount_amount"
        case discPercent        = "disc_percent"
        case usdAmt             = "usd_amt"
        //
        case usdRate            = "usd_rate"
        case cardHolderName     = "card_holder_name"
        case cardNumber         = "card_number"
        case phoneNo            = "phone_no"
        case bankTrxId          = "bank_trx_id"
        case invoiceNo          = "invoice_no"
        case bankStatus         = "bank_status"
        case customerOrderId    = "customer_order_id"
        //
        case spCode             = "sp_code"
        case spMassage          = "sp_massage"
        case name               = "name"
        case email              = "email"
        case address            = "address"
        case city               = "city"
        case transactionStatus  = "transaction_status"
        //
        case dateTime           = "date_time"
        case method             = "method"
        case value1             = "value1"
        case value2             = "value2"
        case value3             = "value3"
        case value4             = "value4"
    }
}

//"[{"id":10810,"order_id":"NOK628640c5f114b","currency":"BDT","amount":1,"payable_amount":1,"discsount_amount":0,"disc_percent":0,"usd_amt":0,"usd_rate":0,"card_holder_name":"master","card_number":"2222xxxxxxxx2222","phone_no":"","bank_trx_id":"628640d4","invoice_no":"NOK628640c5f114b","bank_status":"Success","customer_order_id":"NOK108","sp_code":1000,"sp_massage":"Success","name":"shurjoMukhi Ltd SDK Test","email":"customerEmail","address":"customerAddress","city":"customerCity","value1":"value1","value2":"value2","value3":"value3","value4":"value4","transaction_status":null,"method":"Ebl Visa","date_time":"2022-05-19 19:06:28"}]"
