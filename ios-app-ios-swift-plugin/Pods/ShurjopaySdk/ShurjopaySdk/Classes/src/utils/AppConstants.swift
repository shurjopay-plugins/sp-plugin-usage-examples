//
//  AppConstants.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

public struct AppConstants {
    public static let SDK_TYPE                      = "sdk-type"
    public static let SDK_TYPE_SANDBOX              = "sandbox"
    public static let SDK_TYPE_LIVE                 = "live"
    public static let SDK_TYPE_IPN_SANDBOX          = "ipn-sandbox"
    public static let SDK_TYPE_IPN_LIVE             = "ipn-live"
    public static let BASE_URL_SANDBOX              = "https://sandbox.shurjopayment.com/api/"
    public static let BASE_URL_LIVE                 = "https://engine.shurjopayment.com/api/"
    public static let BASE_URL_IPN_SANDBOX          = "http://ipn.shurjotest.com/"
    public static let BASE_URL_IPN_LIVE             = "http://ipn.shurjopay.com/"
    public static let USER_INPUT_ERROR              = "User input error!"
    public static let PAYMENT_CANCELLED             = "Payment Cancelled!"
    public static let PAYMENT_UKNOWN_ERROR          = "Payment unknown error!"
    public static let PAYMENT_CANCELLED_BY_USER     = "Payment Cancelled By User!"
    public static let PAYMENT_DECLINED              = "Payment has been declined from gateway!"
    public static let PLEASE_CHECK_YOUR_PAYMENT     = "Please Check Your Payment"
    public static let BANK_TRANSACTION_FAILED       = "Bank transaction failed!"
    public static let NO_INTERNET_PERMISSION        = "No internet permission is given!"
    public static let NO_NETWORK_STATE_PERMISSION   = "No network state permission is given!"
    public static let NO_INTERNET_MESSAGE           = "No internet connection! Please check your connection settings."
    public static let INVALID_AMOUNT                = "Invalid amount!"
    public static let DATA                          = "data"
}
