from flask import Blueprint, render_template, request, flash, redirect, url_for
from flask_login import login_required, current_user
from .models import Appointment
from . import db

views = Blueprint('views', __name__)

@views.route('/')
def home():
    return render_template("home.html", user=current_user)

@views.route('/appointment', methods=['GET', 'POST'])
@login_required
def appointment():
    if request.method == 'POST':
        pet_name = request.form.get('pet_name')
        pet_age = request.form.get('pet_age')
        pet_type = request.form.get('pet_type')
        pet_gender = request.form.get('pet_gender')
        pet_color = request.form.get('pet_color')
        drop_off_date = request.form.get('drop_off_date')
        pick_up_date = request.form.get('pick_up_date')

        if not pet_name or not pet_age or not pet_type or not pet_gender or not pet_color:
            flash('Please fill in all the fields', category='error')
        else:
            new_appointment = Appointment(
                pet_name=pet_name,
                pet_age=pet_age,
                pet_type=pet_type,
                pet_gender=pet_gender,
                pet_color=pet_color,
                drop_off_date=drop_off_date,
                pick_up_date=pick_up_date,
                user_id=current_user.id
            )
            db.session.add(new_appointment)
            db.session.commit()
            flash('Appointment successfully created!', category='success')
            return redirect('/appointment')

    appointments = Appointment.query.filter_by(user_id=current_user.id).all()
    return render_template('appointment.html', user=current_user, appointments=appointments)
