from django.db import models

class Appointment(models.Model):
    full_name = models.CharField(max_length=100)
    email = models.EmailField()
    date = models.DateField()
    department = models.CharField(max_length=50, choices=[
        ('general', 'Salud General'),
        ('cardiologia', 'Cardiología'),
        ('dental', 'Dental'),
        ('revision', 'Revisión médica')
    ])
    phone_number = models.CharField(max_length=15)
    message = models.TextField()

    def __str__(self):
        return f'{self.full_name} - {self.date}'