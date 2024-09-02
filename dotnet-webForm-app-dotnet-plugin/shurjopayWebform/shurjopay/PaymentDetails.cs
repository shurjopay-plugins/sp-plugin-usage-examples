/* Author: Wali Mosnad Ayshik
   Description: This page handles the payment form for ShurjoPay integration.
   Date: September 2024 */

using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace shurjopayWebform.shurjopay
{
    public class PaymentDetails
    {
       public string Amount { get; set; }
        public string OrderId { get; set; }
        public string DiscountAmount { get; set; }
        public string ClientIp { get; set; }
        public string CustomerName { get; set; }
        public string CustomerPhone { get; set; }
        public string CustomerEmail { get; set; }
        public string CustomerAddress { get; set; }
        public string CustomerCity { get; set; }
        public string CustomerState { get; set; }
        public string CustomerPostcode { get; set; }
        public string Currency { get; set; }
        public string CustomerCountry { get; set; }

        // Added fields
        public string ShippingAddress { get; set; }
        public string ShippingCity { get; set; }
        public string ShippingCountry { get; set; }
        public string ReceivedPersonName { get; set; }
        public string ShippingPhoneNumber { get; set; }
        public string Value1 { get; set; }
        public string Value2 { get; set; }
        public string Value3 { get; set; }
        public string Value4 { get; set; }
        public string DiscPercent { get; set; }
    }
}