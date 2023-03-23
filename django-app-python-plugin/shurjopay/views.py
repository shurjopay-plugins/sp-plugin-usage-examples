import uuid
from logging import getLogger
from shurjopay_plugin import *

from django.conf import settings
from shurjopay.models import *
from django.shortcuts import render
from django.http import HttpResponseRedirect

logger = getLogger(__name__)

sp_config = ShurjoPayConfigModel(
        SP_USERNAME = getattr(settings,'SP_USERNAME'),
        SP_PASSWORD = getattr(settings,'SP_PASSWORD'),
        SP_ENDPOINT= getattr(settings,'SP_ENDPOINT'),
        SP_RETURN = getattr(settings,'SP_RETURN'),
        SP_CANCEL = getattr(settings,'SP_CANCEL'),
        SP_PREFIX= getattr(settings,'SP_PREFIX'),
        SP_LOGDIR = getattr(settings,'SP_LOGDIR')
        )
shurjopay = ShurjopayPlugin(sp_config) 
    
def index(request):
    return render(request, 'shurjopay/index.html')


def sp_cancel(request):
    if request.method == 'GET':
        return HttpResponseRedirect('/')


def check_payment_view(request):
    return render(request, 'shurjopay/check_payment.html')

def make_payment(request):
    """
    This method is used to make payment using shurjoPay python plugin.
    Redirects to shurjoPay payment gateway if payment request is successful.
    Order can be placed with a order object containing complete order details 
    Order relaed informations are stored into MerchantOrder table
    ShurjoPay related informations can be found in SPTransactions table
    """
    
    my_order_id = str(uuid.uuid4())
    
    if request.method == 'POST':
        payment_request = PaymentRequestModel(
            amount=float(request.POST['amount']),
            order_id= my_order_id,
            currency=request.POST['currency'],
            customer_name=request.POST['customer_name'],
            customer_address=request.POST['customer_address'],
            customer_phone=request.POST['customer_phone'],
            customer_city=request.POST['customer_city'],
            customer_post_code=request.POST['customer_post_code'],
        )
        
        init_payment_details = PaymentDetailsModel(**shurjopay.make_payment(payment_request).__dict__) 
        my_tx_init_result = PaymentDetails.objects.create(**init_payment_details.__dict__)
        
        my_sp_order = MarchentOrder.objects.create(
            my_order_id = uuid.uuid4(),    # Customer order id 
            amount = init_payment_details.amount,
            created_at = datetime.datetime.now(),
            cu_name = init_payment_details.customer_name,
            cu_mobile = init_payment_details.customer_phone,
            cu_address = init_payment_details.customer_address,
            cu_city = init_payment_details.customer_city,
            cu_postcode = request.POST['customer_post_code'],
            sh_contact = request.POST['sh_contact'],
            sh_address = request.POST['sh_address'],
            sh_city = request.POST['sh_city'],
            sh_country = request.POST['sh_country'],
            sh_phone = request.POST['sh_phone'],
            )
         
        SPTransactions.objects.create(
            sp_trxn_id = init_payment_details.sp_order_id,
            tx_status = init_payment_details.transactionStatus,
            tx_amount = init_payment_details.amount,
            tx_currency = request.POST['currency'],
            tx_start_time = datetime.datetime.now(),
            tx_init_res = my_tx_init_result,
            my_order = my_sp_order
            )
        logger.info('Transaction initiated for order id: {}'.format(my_order_id)) 
        
        return HttpResponseRedirect(init_payment_details.checkout_url)

def sp_return(request):
    """
    Update transactiion information if the payment is verified while redirecting  from shurjoPay payment gateway.
    """
    if request.method == 'GET':
        try:
            verified_payment_details = VerifiedPaymentDetailsModel(shurjopay.verify_payment(request.GET['order_id']).__dict__)
            my_verified_payment_details = VerifiedPayment.objects.create(**verified_payment_details.__dict__)
            sp_transaction = SPTransactions.objects.get(sp_trxn_id=request.GET['order_id']) 
            sp_transaction.update(
                tx_status = verified_payment_details.transaction_status,
                bank_trnx_id = verified_payment_details.bank_trx_id,
                bank_status = verified_payment_details.bank_status,
                payment_channel = verified_payment_details.method,
                sp_tx_time = verified_payment_details.date_time,
                tx_vrfy_res = my_verified_payment_details,
                tx_status_details = verified_payment_details.sp_massage,
                receivable_amount = verified_payment_details.recived_amount,
            ) 
            logger.info('Transaction status updated for order id: {}'.format(request.POST['order_id']))    
            return render(request, 'shurjopay/payment_details.html', {'payment_details': verified_payment_details.__dict__})
        except ShurjopayException as e:
            logger.error(msg=ShurjopayPlugin.PAYMENT_VERIFICATION_FAILED)
            
    return render(request, 'shurjopay/index.html')
        
    
def ipn(request):
    """
    Update transactiion information if the payment is verified during ipn calls from shurjoPay payment gateway.
    """
    if request.method == 'POST':
        try:
            verified_payment_details = VerifiedPaymentDetailsModel(shurjopay.verify_payment(request.GET['order_id']).__dict__)
            
            sp_transaction = SPTransactions.objects.get(sp_trxn_id=request.POST['order_id'])
            
            if(sp_transaction.tx_status != verified_payment_details.transaction_status):
                sp_transaction.tx_status = verified_payment_details.bank_status,
                sp_transaction.bank_trnx_id = verified_payment_details.sp_massage,
                sp_transaction.bank_status = verified_payment_details.bank_status,
                sp_transaction.payment_channel = verified_payment_details.method,
                sp_transaction.sp_tx_time = verified_payment_details.date_time,
                sp_transaction.tx_vrfy_res = verified_payment_details,
                sp_transaction.tx_status_details = verified_payment_details.sp_massage,
                sp_transaction.receivable_amount = verified_payment_details.recived_amount,
                sp_transaction.save()
                logger.info('Transaction status updated for order id: {}'.format(request.POST['order_id'])            
            )
        except ShurjopayException as e:
            logger.error(msg=ShurjopayPlugin.PAYMENT_VERIFICATION_FAILED)
         