from django.contrib import admin
from django.urls import path,include

urlpatterns = [
    path("shurjopay/", include('shurjopay.urls')),
]
