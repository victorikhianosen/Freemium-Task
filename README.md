Freemium Task API - Setup & Usage Guide
Clone the Repository
Run the following command to clone the repository and navigate into the project directory:


git clone https://github.com/victorikhianosen/Freemium-Task.git
cd Freemium-Task


Setup Instructions
Install Dependencies
After cloning the repository, install the required dependencies by running:
composer install


Run Database Migrations
Set up your database tables with:
php artisan migrate


Create Storage Symlink
Link your storage with:
php artisan storage:link


Register Endpoint & OTP Setup
When a user registers via the Register endpoint, an OTP is sent to the provided email.
To test OTP functionality, configure your SMTP settings in the .env file.
We recommend using Mailtrap for local testing.
Customer API Endpoints
Get All Customers (Admin View)
Retrieves all customers (Admin access required):
GET http://localhost:8000/api/customer/all


Get Authenticated User's Customers
Retrieves only the customers created by the currently authenticated user:
GET http://localhost:8000/api/customer


Postman Documentation
For detailed API documentation, please refer to the Postman Documentation.


https://documenter.getpostman.com/view/27559246/2sAYdimooY

