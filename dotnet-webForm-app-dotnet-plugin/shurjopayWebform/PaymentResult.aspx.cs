/* Author: Wali Mosnad Ayshik
   Description: This page handles the payment form for ShurjoPay integration.
   Date: September 2024 */

using System;
using System.Threading.Tasks;
using System.Web.UI;
using shurjopayWebform.shurjopay; // Adjust the namespace as needed

namespace shurjopayWebform
{
    public partial class PaymentResult : System.Web.UI.Page
    {
        protected async void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                await HandlePaymentVerificationAsync();
            }
        }

        private async Task HandlePaymentVerificationAsync()
        {
            var orderId = Request.QueryString["order_id"];

            if (string.IsNullOrEmpty(orderId))
            {
                ShowError("Invalid request. Order ID is missing.");
                return;
            }

            try
            {
                var shurjoPayPlugin = new ShurjoPayPlugin();
                var verificationResult = await shurjoPayPlugin.VerifyPaymentAsync(orderId);

                if (verificationResult.SpCode == "1000") // Success code
                {
                    ShowSuccess("We received your purchase request; we'll be in touch shortly!");
                }
                else // Failure code
                {
                    ShowFailure("Your payment failed. Try again later.");
                }
            }
            catch (Exception ex)
            {
                ShowError($"An error occurred: {ex.Message}");
            }
        }

        private void ShowSuccess(string message)
        {
            PlaceHolderMessage.Controls.Add(new LiteralControl(
                $@"
                <div class='card'>
                    <div style='border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;'>
                        <i class='checkmark'>✓</i>
                    </div>
                    <h1>Success</h1>
                    <p>{message}</p>
                    <a href='paymentForm.aspx' class='button'>Pay Again</a>
                </div>"
            ));
        }

        private void ShowFailure(string message)
        {
            PlaceHolderMessage.Controls.Add(new LiteralControl(
                $@"
                <div class='card _failed'>
                    <div style='border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;'>
                        <i class='checkmark'>✗</i>
                    </div>
                    <h1>Failure</h1>
                    <p>{message}</p>
                    <a href='paymentForm.aspx' class='button'>Pay Again</a>
                </div>"
            ));
        }

        private void ShowError(string errorMessage)
        {
            PlaceHolderMessage.Controls.Add(new LiteralControl(
                $@"
                <div class='card _failed'>
                    <div style='border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;'>
                        <i class='checkmark'>✗</i>
                    </div>
                    <h1>Error</h1>
                    <p>{errorMessage}</p>
                    <a href='paymentForm.aspx' class='button'>Pay Again</a>
                </div>"
            ));
        }
    }
}
