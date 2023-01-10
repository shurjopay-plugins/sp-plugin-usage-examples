using Microsoft.AspNetCore.Mvc;
using Shurjopay.Plugin.Models;
using Shurjopay.Plugin;
using Microsoft.Extensions.Options;


namespace dotnetcore_webmvc_dotnet_plugin.Controllers
{
    public class ShurjopayController : Controller
    {
        private readonly ILogger<ShurjopayPlugin> _logger;
        public ShurjopayPlugin _ShurjopayPlugin;
        public ShurjopayController(IOptions<ShurjopayConfig> options, ILogger<ShurjopayPlugin> logger)
        {
            _ShurjopayPlugin = new ShurjopayPlugin(options.Value,logger);
            _logger = logger;
        }

        // GET: ShurjopayController
        public IActionResult Index()
        {
            return View();
        }

        // GET: ShurjopayController/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: ShurjopayController/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(PaymentRequest paymentRequest)
        {
            try
            {
                Task<PaymentDetails?> paymentDetailsTask = _ShurjopayPlugin.MakePayment(paymentRequest);
                PaymentDetails? paymentDetails = paymentDetailsTask.Result;
                return Redirect(paymentDetails.CheckOutUrl);
            }
            catch
            {
                return View();
            }
        }
        // GET: shurjopay/details?order_id={shurjopay order id}
        public ActionResult Details(string order_id)
        {
            try
            {
                Task<VerifiedPayment?> TVerfiedPayment = _ShurjopayPlugin.CheckPayment(order_id);
                return View(TVerfiedPayment.Result);
            }
            catch
            {
                return View();
            }
        }


        [Route("/shurjopay/cancel")]
        [HttpGet]
        public ActionResult Cancel()
        {
            return Redirect("/shurjopay");
        }


        [Route("/shurjopay/return")]
        [HttpGet]
        public ActionResult Return(string order_id)
        {
            try
            {

                Task<VerifiedPayment?> TVerfiedPayment = _ShurjopayPlugin.VerifyPayment(order_id);
                VerifiedPayment? verifiedPayment = TVerfiedPayment.Result;
                // ... omitted for brevity
                return Content(JsonHelper.FromClass<VerifiedPayment>(verifiedPayment));
            }
            catch (Exception ex)
            {
                _logger.LogError(ex.Message);
                throw;
            }
        }

        [Route("/shurjopay/ipn")]
        [HttpGet]
        public ActionResult Ipn(string order_id)
        {
            try
            {

                Task<VerifiedPayment?> TVerfiedPayment = _ShurjopayPlugin.VerifyPayment(order_id);
                VerifiedPayment? verifiedPayment = TVerfiedPayment.Result;
                // ... omitted for brevity
                return Content(JsonHelper.FromClass<VerifiedPayment>(verifiedPayment));
            }
            catch(Exception ex)
            {
                _logger.LogError(ex.Message);
                throw;
            }
        }
    }
}
