//
//  ErrorSuccess.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-16
//

import Foundation

public class ErrorSuccess {
    public var message: String?
    public var esType:  ESType?
    
    public init(message: String, esType: ESType) {
        self.message    = message
        self.esType     = esType
    }
    
    public enum ESType: CaseIterable {
        // ES = Error Success
        case SUCCESS, ERROR
        case INTERNET_SUCCESS, INTERNET_ERROR
        case HTTP_SUCCESS, HTTP_CANCEL, HTTP_URL_LOAD_ERROR, HTTP_ERROR
    }
}
