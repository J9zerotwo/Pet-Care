from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from flask_login import LoginManager
from .database import db  # Import the existing db instance
from .models import User, Appointment  # Ensure models are imported

def create_app():
    app = Flask(__name__)
    app.config['SECRET_KEY'] = '10394812934'
    app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///database.db'

    db.init_app(app)  # Initialize the db instance with your app

    with app.app_context():
        db.create_all()  # Create tables

    from .views import views
    from .auth import auth

    app.register_blueprint(views, url_prefix='/')
    app.register_blueprint(auth, url_prefix='/')

    login_manager = LoginManager()
    login_manager.login_view = 'auth.login'
    login_manager.init_app(app)

    @login_manager.user_loader
    def load_user(user_id):
        from .models import User
        return User.query.get(int(user_id))

    return app
