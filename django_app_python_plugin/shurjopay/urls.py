from django.urls import path

from . import views

urlpatterns = [
    path('', views.index, name='shurjopay'),
    path('make-sp-payment', views.make_payment, name='make-sp-payment'),
]
