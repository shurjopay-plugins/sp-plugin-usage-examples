//
//  ShurjopaySdk.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

public class ShurjopaySdk {
    var shurjopaySdkPlugin: ShurjopaySdkPlugin?
    //var onFailed: ((String) -> Void)?
    public typealias onSuccess  = (_ transactionData: TransactionData?, ErrorSuccess) -> Void
    public typealias onFailed   = (ErrorSuccess) -> Void
    //typealias onProgressView = (Bool) -> Void
    var onSuccess:      onSuccess?
    var onFailed:       onFailed?
    //var onProgressView: onProgressView?
    var uiProperty:     UIProperty?
    var viewController: UIViewController?
    var progressBar:    ProProgressBar?
    //
    //public init() {}
    public init(onSuccess: @escaping onSuccess, onFailed: @escaping onFailed) {
        self.onSuccess  = onSuccess
        self.onFailed   = onFailed
    }
    //
    public func makePayment(uiProperty: UIProperty, sdkType: String, requestData: RequestData) {
        self.uiProperty     = uiProperty
        self.viewController = uiProperty.viewController
        shurjopaySdkPlugin  = ShurjopaySdkPlugin(onSuccess: self.onSuccess!,
                                                onProgressView: self.onProgressView,
                                                onFailed: self.onFailed!)
        shurjopaySdkPlugin?.onSDKPlugin(uiProperty: uiProperty, sdkType: sdkType, requestData: requestData)
        //showProgressView()
    }
    func onProgressView(isShow: Bool) {
        if(isShow) {
            showProgressView()
        } else {
            hideProgressView()
        }
    }
    func showProgressView() {
        progressBar = ProProgressBar(label: "Loading...")
        progressBar?.show(viewController: viewController!)
    }
    func hideProgressView() {
        progressBar?.hide(viewController: viewController!)
        //progressBar?.removeFromSuperview()
    }
}
