from django.db import models
import uuid

class PaymentDetails(models.Model):
    checkout_url = models.URLField()
    amount = models.DecimalField(max_digits=10, decimal_places=2)
    currency = models.CharField(max_length=3)
    sp_order_id = models.CharField(max_length=100)
    customer_order_id = models.CharField(max_length=100)
    customer_name = models.CharField(max_length=100)
    customer_address = models.CharField(max_length=200)
    customer_city = models.CharField(max_length=100)
    customer_phone = models.CharField(max_length=20)
    customer_email = models.EmailField(max_length=30,null=True)
    client_ip = models.GenericIPAddressField()
    intent = models.CharField(max_length=10)
    transactionStatus = models.CharField(max_length=20)
    
class VerifiedPayment(models.Model):
    id = models.IntegerField(primary_key=True)
    order_id = models.CharField(max_length=255)
    currency = models.CharField(max_length=10)
    amount = models.DecimalField(max_digits=10, decimal_places=4)
    payable_amount = models.DecimalField(max_digits=10, decimal_places=4)
    discount_amount = models.DecimalField(max_digits=10, decimal_places=4)
    disc_percent = models.IntegerField()
    recived_amount = models.DecimalField(max_digits=10, decimal_places=4, null=True)
    usd_amt = models.DecimalField(max_digits=10, decimal_places=4)
    usd_rate = models.IntegerField()
    card_holder_name = models.CharField(max_length=255, null=True)
    card_number = models.CharField(max_length=255, null=True)
    phone_no = models.CharField(max_length=255, null=True)
    bank_trx_id = models.CharField(max_length=255, null=True)
    invoice_no = models.CharField(max_length=255, null=True)
    bank_status = models.CharField(max_length=255, null=True)
    customer_order_id = models.CharField(max_length=255, null=True)
    sp_code = models.CharField(max_length=10)
    sp_massage = models.CharField(max_length=255)
    sp_message = models.CharField(max_length=255)
    name = models.CharField(max_length=255)
    email = models.EmailField(null=True)
    address = models.CharField(max_length=255)
    city = models.CharField(max_length=255)
    value1 = models.CharField(max_length=255, null=True)
    value2 = models.CharField(max_length=255, null=True)
    value3 = models.CharField(max_length=255, null=True)
    value4 = models.CharField(max_length=255, null=True)
    transaction_status = models.CharField(max_length=255, null=True)
    method = models.CharField(max_length=255, null=True)
    date_time = models.DateTimeField(null=True)

class MarchentOrder(models.Model):
    my_order_id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    amount = models.DecimalField(max_digits=10, decimal_places=2)
    created_at = models.DateTimeField()
    cu_name = models.CharField(max_length=50, null=True)
    cu_mobile = models.CharField(max_length=20, null=True)
    cu_email = models.EmailField(max_length=30, null=True)
    cu_address = models.CharField(max_length=256, null=True)
    cu_city = models.CharField(max_length=50, null=True)
    cu_postcode = models.IntegerField(null=True)
    sh_contact = models.CharField(max_length=20, null=True)
    sh_address = models.CharField(max_length=256, null=True)
    sh_city = models.CharField(max_length=30, null=True)
    sh_country = models.CharField(max_length=30, null=True)
    sh_phone = models.CharField(max_length=20, null=True)
    
    class Meta:
        db_table = 'marchent_table'


class SPTransactions(models.Model):
    id = models.AutoField(primary_key=True)
    sp_trxn_id = models.CharField(max_length=20)
    tx_status = models.CharField(max_length=20)
    bank_trnx_id = models.CharField(max_length=20,null=True)
    bank_status = models.CharField(max_length=20,null=True)
    tx_amount = models.DecimalField(max_digits=10, decimal_places=2)
    tx_currency = models.CharField(max_length=15)
    payment_channel = models.CharField(max_length=20,null=True)
    tx_start_time = models.DateTimeField()
    sp_tx_time = models.DateTimeField(null=True)
    tx_init_res = models.OneToOneField(PaymentDetails, on_delete=models.CASCADE,null=True)
    tx_vrfy_res = models.OneToOneField(VerifiedPayment, on_delete=models.CASCADE,null=True)
    tx_status_details = models.CharField(max_length=50,null=True)
    receivable_amount = models.DecimalField(max_digits=10, decimal_places=2,null=True)
    my_order = models.ForeignKey(MarchentOrder, on_delete=models.CASCADE)

    class Meta:
        db_table = 'sp_transactions'
        
