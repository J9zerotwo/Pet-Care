from . import db
from flask_login import UserMixin
from sqlalchemy.sql import func

class User(db.Model, UserMixin):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(120), nullable=False)
    appointments = db.relationship('Appointment', backref='user', lazy=True)

class Appointment(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    pet_name = db.Column(db.String(80), nullable=False)
    pet_age = db.Column(db.Integer, nullable=False)
    pet_type = db.Column(db.String(80), nullable=False)
    pet_gender = db.Column(db.String(20), nullable=False)
    pet_color = db.Column(db.String(80), nullable=False)
    drop_off_date = db.Column(db.DateTime, nullable=False)
    pick_up_date = db.Column(db.DateTime, nullable=False)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
