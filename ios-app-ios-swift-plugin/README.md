# ios-swift-shurjopay-sdk-v2
iOS Swift shurjoPay SDK V2

# ShurjopaySdk

[![CI Status](https://img.shields.io/travis/shurjoMukhiDev/ShurjopaySdk.svg?style=flat)](https://travis-ci.org/shurjoMukhiDev/ShurjopaySdk)
[![Version](https://img.shields.io/cocoapods/v/ShurjopaySdk.svg?style=flat)](https://cocoapods.org/pods/ShurjopaySdk)
[![License](https://img.shields.io/cocoapods/l/ShurjopaySdk.svg?style=flat)](https://cocoapods.org/pods/ShurjopaySdk)
[![Platform](https://img.shields.io/cocoapods/p/ShurjopaySdk.svg?style=flat)](https://cocoapods.org/pods/ShurjopaySdk)

## Installation

ShurjopaySdk is available through [CocoaPods](https://cocoapods.org/). To install
it, simply add the following line to your Podfile:

```ruby_podInit
pod init
```

```ruby_shurjoPaySdk
pod "ShurjopaySdk"
// Or
pod "ShurjopaySdk", "~> 1.0"
```

```ruby_podInstall
pod install
// Or
pod update
```

Import package:

```git_request_import
import ShurjopaySdk
```

### Request Data Model Setup:

```git_request_data_model_setup
let requestData = RequestData(
    username:           "username",
    password:           "password",
    prefix:             "prefix",
    currency:           "currency",
    amount:             0,
    orderId:            "orderId",
    discountAmount:     0,
    discPercent:        0,
    customerName:       "customerName",
    customerPhone:      "customerPhone",
    customerEmail:      "customerEmail",
    customerAddress:    "customerAddress",
    customerCity:       "customerCity",
    customerState:      "customerState",
    customerPostcode:   "customerPostcode",
    customerCountry:    "customerCountry",
    returnUrl:          "returnUrl",
    cancelUrl:          "cancelUrl",
    clientIp:           "clientIp",
    value1:             "value1",
    value2:             "value2",
    value3:             "value3",
    value4:             "value4"
)
```

### Response Listener:

```git_response_listener
shurjopaySdk = ShurjopaySdk(onSuccess: onSuccess, onFailed: onFailed)
```

### Payment Request Setup:

```git_payment_request_setup
shurjopaySdk?.makePayment(
    uiProperty:     UIProperty(viewController: self,
                               storyboardName: "Main",
                               identifier: "sPayViewController"),
    sdkType:        AppConstants.SDK_TYPE_SANDBOX,
    requestData:    requestData
)
```
### Response Listener Setup:

```git_response_listener_setup
func onSuccess(transactionData: TransactionData?, message: ErrorSuccess) {
    if(message.esType == ErrorSuccess.ESType.INTERNET_SUCCESS) {
        print("DEBUG_LOG_PRINT: INTERNET SUCCESS \(String(describing: message.message))")
    } else {
        print("DEBUG_LOG_PRINT: HTTP SUCCESS TRANSACTION_DATA: \(String(describing: transactionData)) \(String(describing: message.message))")
    }
}
func onFailed(message: ErrorSuccess) {
    if(message.esType == ErrorSuccess.ESType.INTERNET_ERROR) {
        print("DEBUG_LOG_PRINT: INTERNET ERROR \(String(describing: message.message))")
        //alertService.alert(viewController: self, message: message.message!)
    } else {
        print("DEBUG_LOG_PRINT: HTTP ERROR \(String(describing: message.message))")
    }
}
```

## Author

shurjoMukhi Ltd