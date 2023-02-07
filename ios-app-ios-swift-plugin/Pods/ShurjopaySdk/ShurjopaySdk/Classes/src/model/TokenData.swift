//
//  DataToken.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

struct TokenData: Codable {
    public var username:     String?
    public var password:     String?
    public var token:        String?
    public var storeId:      Int?
    public var executeUrl:   String?
    public var tokenType:    String?
    public var spCode:       Int?
    public var massage:      String?
    public var expiresIn:    Int?
    
    enum CodingKeys: String, CodingKey {
        case username   = "username"
        case password   = "password"
        case token      = "token"
        case storeId    = "store_id"
        case executeUrl = "execute_url"
        case tokenType  = "token_type"
        case spCode     = "sp_code"
        case massage    = "massage"
        case expiresIn  = "expires_in"
    }
}
