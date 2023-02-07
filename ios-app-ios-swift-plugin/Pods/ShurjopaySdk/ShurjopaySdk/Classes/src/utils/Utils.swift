//
//  Utils.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-11
//

import Foundation

class Utils {
    public class func showProgressBar(viewController: UIViewController) {
        let progressView = ProProgressBar(label: "Loading...")
        viewController.view.addSubview(progressView)
    }
}
public enum HttpMethod: String {
    case POST   = "POST"
    case GET    = "GET"
}
extension Utils {
    static func getJsonData(responseData: Data) -> [String: Any]? {
        let jsonResponse: [String: Any]? = nil
        do {
            // create json object from data or use JSONDecoder to convert to Model stuct
            if let jsonData = try JSONSerialization.jsonObject(with: responseData, options: .mutableContainers) as? [String: Any] {
                // handle json response
                return jsonData
            } else {
                print("DEBUG_LOG_PRINT: Data maybe corrupted or in wrong format")
                //throw URLError(.badServerResponse)
            }
        } catch let error {
            print("DEBUG_LOG_PRINT: \(error.localizedDescription)")
        }
        return jsonResponse
    }
    class func onPrintResponseData(responseData: Data) {
        do {
            // create json object from data or use JSONDecoder to convert to Model stuct
            if let jsonResponse = try JSONSerialization.jsonObject(with: responseData, options: .mutableContainers) as? [String: Any] {
                print("DEBUG_LOG_PRINT: JSON_RESPONSE: \(jsonResponse) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
                // handle json response
            } else {
                print("DEBUG_LOG_PRINT: JSON_RESPONSE: Data maybe corrupted or in wrong format CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
                //throw URLError(.badServerResponse)
            }
        } catch let error {
            print("DEBUG_LOG_PRINT: JSON_RESPONSE: \(error.localizedDescription) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        }
    }
}
extension Dictionary {
    public func percentEncoded() -> Data? {
        return map { key, value in
            let escapedKey = "\(key)".addingPercentEncoding(withAllowedCharacters: .urlQueryValueAllowed) ?? ""
            let escapedValue = "\(value)".addingPercentEncoding(withAllowedCharacters: .urlQueryValueAllowed) ?? ""
            return escapedKey + "=" + escapedValue
        }
        .joined(separator: "&")
        .data(using: .utf8)
    }
}

extension CharacterSet {
    public static let urlQueryValueAllowed: CharacterSet = {
        let generalDelimitersToEncode = ":#[]@" // does not include "?" or "/" due to RFC 3986 - Section 3.4
        let subDelimitersToEncode = "!$&'()*+,;="

        var allowed = CharacterSet.urlQueryAllowed
        allowed.remove(charactersIn: "\(generalDelimitersToEncode)\(subDelimitersToEncode)")
        return allowed
    }()
}
public extension String {
    func contains(find: String) -> Bool{
        return self.range(of: find) != nil
    }
    func containsIgnoringCase(find: String) -> Bool{
        return self.range(of: find, options: .caseInsensitive) != nil
    }
}
extension Utils {
    static func onHttpRequest(httpMethod: HttpMethod,
                              location: String,
                              parameters: [String: Any],
                              header: String?,
                              isEncoded: Bool,
                              completionHandler: @escaping (_ data: Data?, _ error: NSError?) -> Void) {
        //print("DEBUG_LOG_PRINT: Parameters: \(parameters) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        let url = URL(string: location)!
        var request = URLRequest(url: url)
        request.addValue("application/x-www-form-urlencoded", forHTTPHeaderField: "Content-Type")
        request.setValue("application/json", forHTTPHeaderField: "Accept")
        if(header != nil) {
            /*let headers: [String: String] = [
                "Content-Type": "application/json",
                "Authorization": header!
            ]*/
            //print("DEBUG_LOG_PRINT: Header: \(String(describing: headers)) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
            request.setValue(header, forHTTPHeaderField: "Authorization")
            //request.allHTTPHeaderFields = headers
            //let str = String(decoding: parameters.percentEncoded()!, as: UTF8.self)
            //request.setValue(str, forHTTPHeaderField: "data")
        }
        request.httpMethod = httpMethod.rawValue
        if(isEncoded) {
            request.httpBody = parameters.percentEncoded()
        } else {
            guard let httpBody = try? JSONSerialization.data(withJSONObject: parameters, options: []) else {
                let nsError = NSError(domain: "Error! parameters format error", code: 1000, userInfo: nil)
                completionHandler(nil, nsError)
                return
            }
            request.httpBody = httpBody
        }
        //
        let session = URLSession.shared
        let task = session.dataTask(with: request) { data, response, error in
            if let error = error {
                //print("DEBUG_LOG_PRINT: POST_REQUEST_ERROR: \(error.localizedDescription)")
                completionHandler(data, error as NSError?)
                return
            }
            // ensure there is valid response code returned from this HTTP response
            guard let httpResponse = response as? HTTPURLResponse,
                  (200...299).contains(httpResponse.statusCode) else {
                //print("DEBUG_LOG_PRINT: Invalid Response received from the server")
                let httpResponse = response as? HTTPURLResponse
                let nsError = NSError(domain: "Invalid Response received from the server CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)", code: httpResponse!.statusCode, userInfo: nil)
                completionHandler(data, nsError)
                return
            }
            guard let responseData = data else {
                //print("DEBUG_LOG_PRINT: nil Data received from the server")
                let httpResponse = response as? HTTPURLResponse
                let nsError = NSError(domain: "nil Data received from the server CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)", code: httpResponse!.statusCode, userInfo: nil)
                completionHandler(data, nsError)
                return
            }
            completionHandler(responseData, error as NSError?)
        }
        task.resume()
    }
}
extension Utils {
    static func onHttpRequest<T: Codable>(httpMethod: HttpMethod,
                              location: String,
                              parameters: T,
                              header: String?,
                              completionHandler: @escaping (_ data: Data?, _ error: NSError?) -> Void) {
        //print("DEBUG_LOG_PRINT: Parameters: \(parameters) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
        let url = URL(string: location)!
        var request = URLRequest(url: url)
        request.addValue("application/x-www-form-urlencoded", forHTTPHeaderField: "Content-Type")
        request.setValue("application/json", forHTTPHeaderField: "Accept")
        if(header != nil) {
            /*let headers: [String: String] = [
                "Content-Type": "application/json",
                "Authorization": header!
            ]*/
            //print("DEBUG_LOG_PRINT: Header: \(String(describing: headers)) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
            request.setValue(header, forHTTPHeaderField: "Authorization")
            //request.allHTTPHeaderFields = headers
            //let str = String(decoding: parameters.percentEncoded()!, as: UTF8.self)
            //request.setValue(str, forHTTPHeaderField: "data")
        }
        request.httpMethod = httpMethod.rawValue
        do {
            let encoder = JSONEncoder()
            let jsonData = try encoder.encode(parameters)
            request.httpBody = jsonData
            //print("DEBUG_LOG_PRINT: JSONEncoder DATA: \(String(decoding: jsonData, as: UTF8.self))")
        } catch {
            let nsError = NSError(domain: "Error! parameters format error CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)", code: 1000, userInfo: nil)
            completionHandler(nil, nsError)
        }
        //
        let session = URLSession.shared
        let task = session.dataTask(with: request) { data, response, error in
            if let error = error {
                //print("DEBUG_LOG_PRINT: POST_REQUEST_ERROR: \(error.localizedDescription) CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
                completionHandler(data, error as NSError?)
                return
            }
            // ensure there is valid response code returned from this HTTP response
            guard let httpResponse = response as? HTTPURLResponse,
                  (200...299).contains(httpResponse.statusCode) else {
                //print("DEBUG_LOG_PRINT: Invalid Response received from the server CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)")
                let httpResponse = response as? HTTPURLResponse
                let nsError = NSError(domain: "Invalid Response received from the server CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)", code: httpResponse!.statusCode, userInfo: nil)
                completionHandler(data, nsError)
                return
            }
            guard let responseData = data else {
                //print("DEBUG_LOG_PRINT: nil Data received from the server")
                let httpResponse = response as? HTTPURLResponse
                let nsError = NSError(domain: "nil Data received from the server CODE: \((#file as NSString).lastPathComponent.replacingOccurrences(of: ".swift", with: "")) \(#function) \(#line)", code: httpResponse!.statusCode, userInfo: nil)
                completionHandler(data, nsError)
                return
            }
            completionHandler(responseData, error as NSError?)
        }
        task.resume()
    }
}
