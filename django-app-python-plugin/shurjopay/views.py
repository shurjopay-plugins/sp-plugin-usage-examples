from django.shortcuts import render, redirect
from django.http import HttpResponse, HttpResponseRedirect
from shurjopay_plugin.shurjopay_plugin import ShurjoPayPlugin
from shurjopay_plugin.models import PaymentRequestModel,ShurjoPayConfigModel
from django.conf import settings

sp_config = ShurjoPayConfigModel(
        SP_USERNAME = settings.SP_USERNAME,
        SP_PASSWORD = settings.SP_PASSWORD,
        SHURJOPAY_API = settings.SHURJOPAY_API,
        SP_CALLBACK = settings.SP_CALLBACK)

shurjopay = ShurjoPayPlugin(sp_config) 
    
def index(request):
    return render(request, 'shurjopay/index.html')


def verify_payment_view(request):
    return render(request, 'shurjopay/index.html')

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
            client_ip=request.POST['client_ip']
        )
        payment_details = shurjopay.make_payment(payment_request)
    return HttpResponseRedirect(payment_details.checkout_url)



