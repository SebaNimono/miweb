from django.shortcuts import render
from django.http import JsonResponse
from django.views.decorators.csrf import csrf_exempt
from .models import Appointment

@csrf_exempt
def make_appointment(request):
    if request.method == 'POST':
        full_name = request.POST.get('full-name')
        email = request.POST.get('email')
        date = request.POST.get('date')
        department = request.POST.get('department')
        phone_number = request.POST.get('phone-number')
        message = request.POST.get('message')

        if not all([full_name, email, date, department, phone_number, message]):
            return JsonResponse({'status': 'fail', 'message': 'Todos los campos son obligatorios.'})

        appointment = Appointment.objects.create(
            full_name=full_name,
            email=email,
            date=date,
            department=department,
            phone_number=phone_number,
            message=message
        )
        return JsonResponse({'status': 'success', 'message': 'Cita creada exitosamente.'})
    return JsonResponse({'status': 'fail', 'message': 'Método no permitido.'})




