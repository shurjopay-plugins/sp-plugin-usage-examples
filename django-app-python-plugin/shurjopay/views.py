from django.conf import settings
from .models import OrderHistory
from django.shortcuts import render
from django.http import HttpResponseRedirect
from shurjopay_plugin import ShurjopayPlugin
from shurjopay_plugin import ShurjoPayConfigModel, PaymentRequestModel, VerifiedPaymentDetailsModel


sp_config = ShurjoPayConfigModel(
        SP_USERNAME = settings.SP_USERNAME,
        SP_PASSWORD = settings.SP_PASSWORD,
        SP_ENDPOINT= settings.SP_ENDPOINT,
        SP_RETURN = settings.SP_RETURN,
        SP_CANCEL = settings.SP_CANCEL,
        SP_PREFIX= settings.SP_PREFIX,
        SP_LOGDIR = settings.SP_LOGDIR,
        )
shurjopay = ShurjopayPlugin(sp_config) 
    
def index(request):
    return render(request, 'shurjopay/index.html')


def check_payment_view(request):
    return render(request, 'shurjopay/check_payment.html')

def make_payment(request):
    if request.method == 'POST':
        payment_request = PaymentRequestModel(
            amount=float(request.POST['amount']),
            order_id=request.POST['order_id'],
            currency=request.POST['currency'],
            customer_name=request.POST['customer_name'],
            customer_address=request.POST['customer_address'],
            customer_phone=request.POST['customer_phone'],
            customer_city=request.POST['customer_city'],
            customer_post_code=request.POST['customer_post_code'],
        )
        payment_details = shurjopay.make_payment(payment_request)
    return HttpResponseRedirect(payment_details.checkout_url)

def check_payment(request):
    if request.method == 'POST':
        verified_payment_details = shurjopay.check_payment_status(request.POST['order_id'])
        return render(request, 'shurjopay/payment_details.html', {'payment_details': verified_payment_details.__dict__})

def sp_return(request):
    if request.method == 'GET':
        verified_payment_details = shurjopay.verify_payment(request.GET['order_id'])
        return render(request, 'shurjopay/payment_details.html', {'payment_details': verified_payment_details.__dict__})

def sp_cancel(request):
    if request.method == 'GET':
        return HttpResponseRedirect('/')

def ipn(request):
    if request.method == 'POST':
        response = shurjopay.verify_payment(request.POST['order_id'])
        if response:
            OrderHistory.objects.create(  
                amount = response.amount,
                order_id = response.order_id,
                transaction_method = response.method,   
                currency = response.currency,
                customer_order_id = response.customer_order_id,
                customer_name = response.name,
                customer_address = response.address,
                customer_phone = response.phone_no,
                customer_city = response.city,
                card_number = response.card_number, 
                card_holder_name = response.card_holder_name,
                invoice_no = response.invoice_no,
                
            )
            return render(request, 'shurjopay/payment_details.html', {'payment_details': response.__dict__})
