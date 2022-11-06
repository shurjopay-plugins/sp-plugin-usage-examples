from django.urls import path

from . import views

urlpatterns = [
    path('', views.index, name='shurjopay'),
    path('make-sp-payment', views.make_payment, name='make-sp-payment'),
    path('verify-sp-payment-form', views.verify_payment_view),
    path('verify-sp-payment', views.verify_payment,name='verify-sp-payment'),
]
