from django.db import models

# Create your models here.
class OrderHistory(models.Model):
    prefix = models.CharField(max_length=10)
    amount = models.FloatField()
    transaction_method = models.CharField(max_length=10)
    order_id = models.CharField(max_length=100)
    currency = models.CharField(max_length=10)
    customer_order_id = models.CharField(max_length=100)
    customer_name = models.CharField(max_length=100)
    customer_address = models.CharField(max_length=100)
    customer_phone = models.CharField(max_length=100)
    customer_city = models.CharField(max_length=100)
    card_number = models.CharField(max_length=100,null=True,blank=True)
    card_holder_name = models.CharField(max_length=100 ,null=True,blank=True)
    invoice_no = models.CharField(max_length=100 ,null=True,blank=True)
    def __str__(self):
        return self.order_id


    