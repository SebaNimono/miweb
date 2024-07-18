# appointments/urls.py
from django.urls import path
from .views import make_appointment

urlpatterns = [
    path('make_appointment/', make_appointment, name='make_appointment'),
]
