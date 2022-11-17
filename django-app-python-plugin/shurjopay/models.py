from django.db import models

# Create your models here.
class OrderHistory(models.Model):
    prefix = models.CharField(max_length=10)
    amount = models.FloatField()
    order_id = models.CharField(max_length=100)
    currency = models.CharField(max_length=10)
    customer_name = models.CharField(max_length=100)
    customer_address = models.CharField(max_length=100)
    customer_phone = models.CharField(max_length=100)
    customer_city = models.CharField(max_length=100)
    customer_post_code = models.CharField(max_length=100)
    def __str__(self):
        return self.order_id