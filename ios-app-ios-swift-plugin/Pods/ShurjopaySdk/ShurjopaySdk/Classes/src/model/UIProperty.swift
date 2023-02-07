//
//  UIProperty.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-20
//

import Foundation

public struct UIProperty {
    var viewController: UIViewController
    var storyboardName: String
    var identifier:     String
    
    public init(viewController: UIViewController, storyboardName: String, identifier: String) {
        self.viewController = viewController
        self.storyboardName = storyboardName
        self.identifier     = identifier
    }
}
