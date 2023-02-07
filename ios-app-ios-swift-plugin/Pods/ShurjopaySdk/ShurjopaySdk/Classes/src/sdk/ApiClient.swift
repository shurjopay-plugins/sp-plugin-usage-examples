//
//  ApiClient.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-17
//

import Foundation

class ApiClient {
    class func getApiClient(sdkType: String) -> ApiInterface {
        return ApiInterface(baseUrl: getBaseUrl(sdkType: sdkType))
    }
    static func getBaseUrl(sdkType: String) -> String {
        var baseUrl: String = AppConstants.BASE_URL_SANDBOX
        if (sdkType == AppConstants.SDK_TYPE_SANDBOX) {
            baseUrl = AppConstants.BASE_URL_SANDBOX
        } else if (sdkType == AppConstants.SDK_TYPE_LIVE) {
            baseUrl = AppConstants.BASE_URL_LIVE
        } else if (sdkType == AppConstants.SDK_TYPE_IPN_SANDBOX) {
            baseUrl = AppConstants.BASE_URL_IPN_SANDBOX
        } else if (sdkType == AppConstants.SDK_TYPE_IPN_LIVE) {
            baseUrl = AppConstants.BASE_URL_IPN_LIVE
        }
        return baseUrl
    }
}
