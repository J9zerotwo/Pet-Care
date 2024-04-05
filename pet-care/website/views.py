from flask import Blueprint, app, render_template, request, flash, redirect, url_for
from flask_login import login_required, current_user
from .models import Appointment
from datetime import datetime
from . import db

views = Blueprint('views', __name__)

@views.route('/')
def home():
    return render_template("home.html", user=current_user)

@views.route('/appointment', methods=['GET', 'POST', ''])
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

        # Convert string dates to datetime.date objects
        try:
            drop_off_date = datetime.strptime(drop_off_date, '%Y-%m-%d').date()
            pick_up_date = datetime.strptime(pick_up_date, '%Y-%m-%d').date()
        except ValueError:
            flash('Invalid date format. Please use YYYY-MM-DD.', category='error')
            return redirect('/appointment')

        if not pet_name or not pet_age or not pet_type or not pet_gender or not pet_color:
            flash('Please fill in all the fields', category='error')

        else:
            # Check if there's an existing appointment for the same pet on the same day
            existing_appointment = Appointment.query.filter_by(pet_name=pet_name, drop_off_date=drop_off_date).first()
            if existing_appointment:
                flash('An appointment for this pet already exists on this date.', category='error')
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


@views.route('/cancel/<int:id>', methods=['POST'])
def cancel_appointment(id):
    appointment = Appointment.query.get_or_404(id)
    db.session.delete(appointment)
    db.session.commit()
    return redirect('/appointment')
