//
//  WebViewContainer.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-18
//

import Foundation
import UIKit
import WebKit

class ShurjoPayViewController: UIViewController {
    typealias onSuccess         = (_ transactionData: TransactionData?, ErrorSuccess) -> Void
    typealias onFailed          = (ErrorSuccess) -> Void
    typealias onProgressView    = (Bool) -> Void
    var onSuccess:      onSuccess?
    var onFailed:       onFailed?
    var onProgressView: onProgressView?
    private let webView         = WKWebView()
    private var requestData:    RequestData?
    private var tokenData:      TokenData?
    private var checkoutData:   CheckoutData?
    private var sdkType:        String?
    private var isSuccessUrl:   Bool = false
    //
    override func viewDidLoad() {
        super.viewDidLoad()
        onCreateView()
    }
    func setListener(onSuccess: @escaping onSuccess,
                     onProgressView: @escaping onProgressView,
                     onFailed: @escaping onFailed) {
        self.onSuccess      = onSuccess
        self.onProgressView = onProgressView
        self.onFailed       = onFailed
    }
    func onLoadData(sdkType: String, requestData: RequestData, tokenData: TokenData, checkoutData: CheckoutData) {
        self.requestData    = requestData
        self.sdkType        = sdkType
        self.tokenData      = tokenData
        self.checkoutData   = checkoutData
        onLoad(location: checkoutData.checkoutUrl!)
    }
    private func onCreateView() {
        for view in self.view.subviews {
            view.removeFromSuperview()
        }
        webView.scrollView.showsHorizontalScrollIndicator = false
        webView.frame  = CGRect(x: 0, y: 0, width: UIScreen.main.bounds.width, height: UIScreen.main.bounds.height)
        self.view.addSubview(webView)
        webView.navigationDelegate = self
    }
    private func onLoad(location: String) {
        let url = URL(string: location)!
        webView.load(URLRequest(url: url))
    }
}
extension ShurjoPayViewController: WKNavigationDelegate, UIWebViewDelegate {
    func webView(_ webView: WKWebView, didFinish navigation: WKNavigation!) {
        //print("Finished navigating to url \(String(describing: webView.url)) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        /*if ((webView.url?.absoluteString.contains("facebook.com")) != nil) {
            // do something here
        }*/
        /*guard let url = webView.url?.path else {
            return
        }*/
        let url = webView.url?.absoluteString
        //print("Finished navigating to url \(String(describing: url)) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        /*if url!.containsIgnoringCase(find: "cancel_url") {
            self.onFailed?(ErrorSuccess(
                message:    "Error: Cancel by user CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                esType:     ErrorSuccess.ESType.HTTP_CANCEL
            ))
            self.dismiss(animated: true, completion: nil)
            return
        }
        if url!.containsIgnoringCase(find: "return_url") || url!.containsIgnoringCase(find: "order_id") {
            isSuccessUrl = true
            verifyPayment(sdkType: sdkType!)
        }*/
        //print("DEBUG_LOG_PRINT: enert outside if condition \(String(describing: url))")
        let returnUrl = (requestData?.returnUrl)!
        let cancelUrl = (requestData?.cancelUrl)!
        if url!.containsIgnoringCase(find: returnUrl) || url!.containsIgnoringCase(find: cancelUrl) {
            isSuccessUrl = true
            //print("DEBUG_LOG_PRINT: enert inside if condition")
            verifyPayment(sdkType: sdkType!)
        }
    }
    func webView(_ webView: WKWebView, didFailProvisionalNavigation navigation: WKNavigation!, withError error: Error) {
        //let url = webView.url?.path
        //print("Error navigating to url \(String(describing: url)) \(isSuccessUrl) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        let returnUrl = (requestData?.returnUrl)!
        let cancelUrl = (requestData?.cancelUrl)!
        if let urlError = error as? URLError {
            //webView.loadHTMLString(urlError.localizedDescription, baseURL: urlError.failingURL)
            //print("DEBUG_LOG_PRINT: WEB LOAD ERROR \(urlError.errorCode)")
            //print("DEBUG_LOG_PRINT: WEB LOAD ERROR \(String(describing: urlError.failureURLString))")
            if urlError.failureURLString!.containsIgnoringCase(find: returnUrl) {
                self.onFailed?(ErrorSuccess(
                    message:    "Error: Provided returnUrl not valid \(urlError.errorCode) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_URL_LOAD_ERROR
                ))
                self.dismiss(animated: true, completion: nil)
                return
            } else if urlError.failureURLString!.containsIgnoringCase(find: cancelUrl) {
                self.onFailed?(ErrorSuccess(
                    message:    "Error: Provided cancelUrl not valid \(urlError.errorCode) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_URL_LOAD_ERROR
                ))
                self.dismiss(animated: true, completion: nil)
                return
            }
            self.onFailed?(ErrorSuccess(
                message:    "Error: Provided url not valid \(urlError.errorCode) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                esType:     ErrorSuccess.ESType.HTTP_URL_LOAD_ERROR
            ))
            self.dismiss(animated: true, completion: nil)
            return
        } else {
            //webView.loadHTMLString(error.localizedDescription, baseURL: URL(string: "data:text/html"))
        }
    }
}
extension ShurjoPayViewController {
    func verifyPayment(sdkType: String) {
        //self.dismiss(animated: true, completion: nil)
        let verifyUrl = ApiClient.getApiClient(sdkType: sdkType).verify()
        //let verifyUrl = "https://rzrasel.000webhostapp.com/plugins.php"
        //let verifyUrl = "http://192.168.10.61/plugins.php"
        //print("DEBUG_LOG_PRINT: VERIFY_URL: \(verifyUrl) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        let parameters: [String: Any] = [
            "order_id": checkoutData?.spOrderId! ?? ""
        ]
        let header = (tokenData?.tokenType)! + " " + (tokenData?.token)!
        Utils.onHttpRequest(httpMethod: HttpMethod.POST, location: verifyUrl, parameters: parameters, header: header, isEncoded: true) {
            (data: Data?, error: Error?) in
            guard error == nil else {
                self.dismissWindow()
                self.onFailed?(ErrorSuccess(
                    message:    "ERROR: \(error!.localizedDescription) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_ERROR
                ))
                return
            }
            /*let str = String(decoding: data!, as: UTF8.self)
            print("DEBUG_LOG_PRINT: DATA_RESPONS \(str) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")*/
            var transactionDataList: [TransactionData] = []
            do {
                let decoder = JSONDecoder()
                transactionDataList = try decoder.decode([TransactionData].self, from: data!)
                //print("DEBUG_LOG_PRINT: TransactionData: \(transactionDataList)")
            }
            catch {
                self.dismissWindow()
                //print (error)
                self.onFailed?(ErrorSuccess(
                    message:    "ERROR: \(error.localizedDescription) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_ERROR
                ))
                return
            }
            if(transactionDataList.count < 1) {
                self.dismissWindow()
                self.onFailed?(ErrorSuccess(
                    message:    "ERROR: Transaction data not found CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_ERROR
                ))
                return
            }
            let transactionData: TransactionData = transactionDataList[transactionDataList.count - 1]
            if(transactionData.spCode == 1000) {
                self.dismissWindow()
                self.onSuccess?(transactionData, ErrorSuccess(
                    message:    "SUCCESS: Transaction success CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_SUCCESS
                ))
                return
            } else {
                self.dismissWindow()
                self.onFailed?(ErrorSuccess(
                    message:    "ERROR: Transaction failed sp code CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)",
                    esType:     ErrorSuccess.ESType.HTTP_ERROR
                ))
                return
            }
        }
    }
    
    func dismissWindow() {
        DispatchQueue.global(qos: .userInitiated).async {
            // Perform task
            DispatchQueue.main.async {
                self.dismiss(animated: true, completion: nil)
            }
        }
    }
}
