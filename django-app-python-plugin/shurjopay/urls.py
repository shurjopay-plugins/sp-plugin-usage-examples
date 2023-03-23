from django.urls import path
from django.contrib import admin

from shurjopay import views

urlpatterns = [
    path ('admin/', admin.site.urls),
    path('', views.index, name='shurjopay'),
    path('make-sp-payment', views.make_payment, name='make-sp-payment'),
    path('ipn', views.ipn,name='ipn'),
    path('return', views.sp_return,name='return'),
    path('cancel', views.sp_cancel,name='cancel'),
    path('check-payment', views.check_payment_view),
]
