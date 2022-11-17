from django.conf import settings
from .models import OrderHistory
from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect
from shurjopay_plugin.shurjopay_plugin import ShurjoPayPlugin
from shurjopay_plugin.models import PaymentRequestModel,ShurjoPayConfigModel
from shurjopay_plugin.shurjopay_status_codes import *

sp_config = ShurjoPayConfigModel(
        SP_USERNAME = settings.SP_USERNAME,
        SP_PASSWORD = settings.SP_PASSWORD,
        SHURJOPAY_API = settings.SHURJOPAY_API,
        SP_CALLBACK = settings.SP_CALLBACK)

shurjopay = ShurjoPayPlugin(sp_config) 
    
def index(request):
    return render(request, 'shurjopay/index.html')


def check_payment_view(request):
    return render(request, 'shurjopay/check_payment.html')

def make_payment(request):
    if request.method == 'POST':
        payment_request = PaymentRequestModel(
            prefix=request.POST['prefix'],
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
    if request.method == 'GET':
        verified_payment_details = shurjopay.check_payment_status(request.GET['order_id'])
        if verified_payment_details.sp_code == SHURJOPAY_STATUS_CODES['SHURJOPAY_SUCCESS']:
            OrderHistory.objects.create(  
                prefix = verified_payment_details.prefix,
                amount = verified_payment_details.amount,
                order_id = verified_payment_details.order_id,
                currency = verified_payment_details.currency,
                customer_name = verified_payment_details.customer_name,
                customer_address = verified_payment_details.customer_address,
                customer_phone = verified_payment_details.customer_phone,
                customer_city = verified_payment_details.customer_city,
                customer_post_code = verified_payment_details.customer_post_code,
            )
            return render(request, 'shurjopay/payment_details.html', {'payment_details': verified_payment_details.__dict__})
        else:
            return HttpResponse(get_status_by_code(verified_payment_details.sp_code))