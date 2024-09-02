using System;
using System.Threading.Tasks;
using System.Web.UI;
using shurjopayWebform.shurjopay;
using System.Diagnostics;
using Antlr.Runtime;
namespace shurjopayWebform
{
    public partial class PaymentForm : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (!IsPostBack)
            {
                Console.WriteLine("Raw paymentd");
            }
        }

        protected async void btnPayNow_Click(object sender, EventArgs e)
        {
            // Display a confirmation message (you can replace this with actual payment logic)
          

            // Create a PaymentDetails object
            var paymentDetails = new PaymentDetails
            {
                Amount = txtAmount.Text,
                OrderId = txtOrderId.Text,
                DiscountAmount = txtDiscountAmount.Text,
                ClientIp = txtClientIp.Text,
                CustomerName = txtCustomerName.Text,
                CustomerPhone = txtCustomerPhone.Text,
                CustomerEmail = txtCustomerEmail.Text,
                CustomerAddress = txtCustomerAddress.Text,
                CustomerCity = txtCustomerCity.Text,
                CustomerState = txtCustomerState.Text,
                CustomerPostcode = txtCustomerPostcode.Text,
                Currency = txtCurrency.Text,
                CustomerCountry = txtCustomerCountry.Text,
                // Added fields
                ShippingAddress = "N/A",         
                ShippingCity = "N/A",                
                ShippingCountry = "N/A",          
                ReceivedPersonName = "N/A",    
                ShippingPhoneNumber = "N/A",  
                Value1 = "N/A",                           
                Value2 = "N/A",                           
                Value3 = "N/A",                            
                Value4 = "N/A",               
                DiscPercent = "0"
            };

            try
            {
                // Create an instance of ShurjoPayPlugin
                var shurjoPay = new ShurjoPayPlugin();

                // Initiate payment
                var paymentResponse = await shurjoPay.InitiatePaymentAsync(paymentDetails);

                // Redirect to ShurjoPay checkout URL
                Response.Redirect(paymentResponse.CheckoutUrl);
            }
            catch (Exception ex)
            {
                // Handle errors
                lblMessage.Text = $"Error: {ex.Message}";
                lblMessage.ForeColor = System.Drawing.Color.Red;
            }
        }
    }
}
