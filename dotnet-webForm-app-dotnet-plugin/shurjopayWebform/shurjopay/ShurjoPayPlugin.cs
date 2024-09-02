/* Author: Wali Mosnad Ayshik
   Description: This page handles the payment form for ShurjoPay integration.
   Date: September 2024 */

using System;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using System.Diagnostics;
using System.Collections.Generic;
using System.Linq;

namespace shurjopayWebform.shurjopay
{
    public class ShurjoPayPlugin
    {
        private readonly HttpClient _httpClient;
        private readonly string _username;
        private readonly string _password;
        private readonly string _endpoint;
        private readonly string _callback;
        private readonly string _prefix;

        public ShurjoPayPlugin()
        {
            _httpClient = new HttpClient();
            _username = System.Configuration.ConfigurationManager.AppSettings["SP_USERNAME"];
            _password = System.Configuration.ConfigurationManager.AppSettings["SP_PASSWORD"];
            _endpoint = System.Configuration.ConfigurationManager.AppSettings["SP_ENDPOINT"];
            _callback = System.Configuration.ConfigurationManager.AppSettings["SP_CALLBACK"];
            _prefix = System.Configuration.ConfigurationManager.AppSettings["SP_PREFIX"];
        }

        public async Task<(string Token, int StoreId)> GetTokenAsync()
        {
            var tokenResponse = await _httpClient.PostAsync(
                $"{_endpoint}get_token",
                new StringContent(
                    JsonConvert.SerializeObject(new { username = _username, password = _password }),
                    Encoding.UTF8,
                    "application/json"
                )
            );

            tokenResponse.EnsureSuccessStatusCode();
            var tokenResponseString = await tokenResponse.Content.ReadAsStringAsync();
            // Log the raw response content
            System.Diagnostics.Debug.WriteLine($"Token Response: {tokenResponseString}");

            var tokenData = JsonConvert.DeserializeObject<TokenResponse>(tokenResponseString);

            return (tokenData.Token, tokenData.StoreId);
        }

        public async Task<PaymentResponse> InitiatePaymentAsync(PaymentDetails paymentDetails)
        {
            // Retrieve token and store ID
            var (token, storeId) = await GetTokenAsync();

            // Set the Bearer token in the request headers
            _httpClient.DefaultRequestHeaders.Authorization = new System.Net.Http.Headers.AuthenticationHeaderValue("Bearer", token);

            // Create the content for the POST request
            var paymentRequestData = new
            {
                token = token,
                store_id = storeId,
                prefix = _prefix,
                return_url = _callback,
                cancel_url = _callback,
                amount = paymentDetails.Amount,
                order_id = paymentDetails.OrderId,
                discount_amount = paymentDetails.DiscountAmount,
                disc_percent = paymentDetails.DiscPercent,
                client_ip = paymentDetails.ClientIp,
                customer_name = paymentDetails.CustomerName,
                customer_phone = paymentDetails.CustomerPhone,
                customer_email = paymentDetails.CustomerEmail,
                customer_address = paymentDetails.CustomerAddress,
                customer_city = paymentDetails.CustomerCity,
                customer_state = paymentDetails.CustomerState,
                customer_postcode = paymentDetails.CustomerPostcode,
                currency = paymentDetails.Currency,
                customer_country = paymentDetails.CustomerCountry,
                shipping_address = paymentDetails.ShippingAddress,
                shipping_city = paymentDetails.ShippingCity,
                shipping_country = paymentDetails.ShippingCountry,
                received_person_name = paymentDetails.ReceivedPersonName,
                shipping_phone_number = paymentDetails.ShippingPhoneNumber,
                value1 = paymentDetails.Value1,
                value2 = paymentDetails.Value2,
                value3 = paymentDetails.Value3,
                value4 = paymentDetails.Value4
            };

            // Convert to JSON string
            var paymentJson = JsonConvert.SerializeObject(paymentRequestData);

            // Log the JSON string for debugging
            System.Diagnostics.Debug.WriteLine($"Payment JSON: {paymentJson}");

            // Create the StringContent for the POST request
            var paymentContent = new StringContent(
                paymentJson,
                Encoding.UTF8,
                "application/json"
            );

            // Send the POST request to the API endpoint
            var paymentResponse = await _httpClient.PostAsync(
                $"{_endpoint}secret-pay",
                paymentContent
            );

            paymentResponse.EnsureSuccessStatusCode();
            var paymentResponseString = await paymentResponse.Content.ReadAsStringAsync();
            //System.Diagnostics.Debug.WriteLine($"CheckoutUrl: {paymentResponseString}");

            // Deserialize the response into PaymentResponse
            var paymentResult = JsonConvert.DeserializeObject<PaymentResponse>(paymentResponseString);


            return paymentResult;
        }

        public async Task<PaymentVerificationResponse> VerifyPaymentAsync(string orderId)
        {
            // Retrieve token and store ID
            var (token, _) = await GetTokenAsync(); // Store ID is not needed for verification, so we ignore it here.

            // Set the Bearer token in the request headers
            _httpClient.DefaultRequestHeaders.Authorization = new System.Net.Http.Headers.AuthenticationHeaderValue("Bearer", token);

            // Create the content for the POST request
            var verificationRequestData = new
            {
                order_id = orderId
            };

            // Convert to JSON string
            var verificationJson = JsonConvert.SerializeObject(verificationRequestData);

            // Log the JSON string for debugging
            System.Diagnostics.Debug.WriteLine($"Verification JSON: {verificationJson}");

            // Create the StringContent for the POST request
            var verificationContent = new StringContent(
                verificationJson,
                Encoding.UTF8,
                "application/json"
            );

            // Send the POST request to the API endpoint
            var verificationResponse = await _httpClient.PostAsync(
                $"{_endpoint}verification", // Replace with the actual verification endpoint if different
                verificationContent
            );

            verificationResponse.EnsureSuccessStatusCode();
            var verificationResponseString = await verificationResponse.Content.ReadAsStringAsync();
            System.Diagnostics.Debug.WriteLine($"Verification Response: {verificationResponseString}");

            // Deserialize the response into a list of PaymentVerificationResponse
            var verificationResults = JsonConvert.DeserializeObject<List<PaymentVerificationResponse>>(verificationResponseString);

            // Handle the case where no results are returned
            if (verificationResults == null || !verificationResults.Any())
            {
                throw new Exception("No verification results found.");
            }

            // Return the first result (assuming order_id is unique and only one result will be returned)
            return verificationResults.First();
        }
    }

        public class TokenResponse
    {
        [JsonProperty("token")]
        public string Token { get; set; }

        [JsonProperty("store_id")]
        public int StoreId { get; set; }

        [JsonProperty("execute_url")]
        public string ExecuteUrl { get; set; }

        [JsonProperty("token_type")]
        public string TokenType { get; set; }

        [JsonProperty("sp_code")]
        public string SpCode { get; set; }

        [JsonProperty("message")]
        public string Message { get; set; }

        [JsonProperty("token_create_time")]
        public string TokenCreateTime { get; set; }

        [JsonProperty("expires_in")]
        public int ExpiresIn { get; set; }
    }

    public class PaymentResponse
    {
        [JsonProperty("checkout_url")]
        public string CheckoutUrl { get; set; }

        [JsonProperty("amount")]
        public string Amount { get; set; }

        [JsonProperty("currency")]
        public string Currency { get; set; }

        [JsonProperty("sp_order_id")]
        public string SpOrderId { get; set; }

        [JsonProperty("customer_order_id")]
        public string CustomerOrderId { get; set; }

        [JsonProperty("customer_name")]
        public string CustomerName { get; set; }

        [JsonProperty("customer_address")]
        public string CustomerAddress { get; set; }

        [JsonProperty("customer_city")]
        public string CustomerCity { get; set; }

        [JsonProperty("customer_phone")]
        public string CustomerPhone { get; set; }

        [JsonProperty("customer_email")]
        public string CustomerEmail { get; set; }

        [JsonProperty("client_ip")]
        public string ClientIp { get; set; }

        [JsonProperty("intent")]
        public string Intent { get; set; }

        [JsonProperty("transactionStatus")]
        public string TransactionStatus { get; set; }
    }

    public class PaymentVerificationResponse
    {
        [JsonProperty("id")]
        public int Id { get; set; }

        [JsonProperty("order_id")]
        public string OrderId { get; set; }

        [JsonProperty("currency")]
        public string Currency { get; set; }

        [JsonProperty("amount")]
        public decimal Amount { get; set; }

        [JsonProperty("payable_amount")]
        public decimal PayableAmount { get; set; }

        [JsonProperty("discount_amount")]
        public decimal DiscountAmount { get; set; } // Change type to decimal to match the JSON

        [JsonProperty("disc_percent")]
        public int DiscPercent { get; set; }

        [JsonProperty("received_amount")]
        public decimal ReceivedAmount { get; set; } // Change type to decimal to match the JSON

        [JsonProperty("usd_amt")]
        public decimal UsdAmt { get; set; }

        [JsonProperty("usd_rate")]
        public int UsdRate { get; set; }

        [JsonProperty("is_verify")]
        public int IsVerify { get; set; }

        [JsonProperty("card_holder_name")]
        public string CardHolderName { get; set; }

        [JsonProperty("card_number")]
        public string CardNumber { get; set; }

        [JsonProperty("phone_no")]
        public string PhoneNo { get; set; } // Property name updated to match JSON

        [JsonProperty("bank_trx_id")]
        public string BankTrxId { get; set; } // Add this property

        [JsonProperty("invoice_no")]
        public string InvoiceNo { get; set; } // Add this property

        [JsonProperty("bank_status")]
        public string BankStatus { get; set; } // Add this property

        [JsonProperty("customer_order_id")]
        public string CustomerOrderId { get; set; } // Add this property

        [JsonProperty("sp_code")]
        public string SpCode { get; set; } // Add this property

        [JsonProperty("sp_massage")]
        public string SpMassage { get; set; } // Corrected to match JSON typo

        [JsonProperty("sp_message")]
        public string SpMessage { get; set; } // Add this property

        [JsonProperty("name")]
        public string Name { get; set; } // Add this property

        [JsonProperty("email")]
        public string Email { get; set; } // Add this property

        [JsonProperty("address")]
        public string Address { get; set; } // Add this property

        [JsonProperty("city")]
        public string City { get; set; } // Add this property

        [JsonProperty("value1")]
        public string Value1 { get; set; } // Add this property

        [JsonProperty("value2")]
        public string Value2 { get; set; } // Add this property

        [JsonProperty("value3")]
        public string Value3 { get; set; } // Add this property

        [JsonProperty("value4")]
        public string Value4 { get; set; } // Add this property

        [JsonProperty("transaction_status")]
        public string TransactionStatus { get; set; }

        [JsonProperty("method")]
        public string Method { get; set; } // Add this property

        [JsonProperty("date_time")]
        public string DateTime { get; set; } // Add this property

        // Properties not directly in the JSON response
        [JsonProperty("card_type")]
        public string CardType { get; set; }

        [JsonProperty("transaction_id")]
        public string TransactionId { get; set; }

        [JsonProperty("payment_date")]
        public string PaymentDate { get; set; }

        [JsonProperty("payment_mode")]
        public string PaymentMode { get; set; }

        [JsonProperty("customer_name")]
        public string CustomerName { get; set; }

        [JsonProperty("customer_email")]
        public string CustomerEmail { get; set; }

        [JsonProperty("customer_phone")]
        public string CustomerPhone { get; set; }

        [JsonProperty("client_ip")]
        public string ClientIp { get; set; }

        [JsonProperty("transaction_amount")]
        public decimal TransactionAmount { get; set; }

        [JsonProperty("reference_id")]
        public string ReferenceId { get; set; }
    }

}
