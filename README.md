# Test Lumen 9 App with Users and Companies
## Introduction
This is a sample test Lumen 9 app that demonstrates the use of Lumen 9, a micro-framework by Laravel, to create a RESTful API for managing users and companies.

## Features
- Users can be registered and managed through the API.
- Companies can be created and associated with lgged in users through the API.
- User authentication is implemented using simple bearer token logic.
## Prerequisites
- Docker-compose
- Composer
- PostgreSQL database
- Installation
- Clone the repository to your local machine:

## Installation

1. git clone https://github.com/rumus-bin/lumen_user_companies_app.git

2. Navigate to the project directory:


        cd lumen_user_companies_app


3. Install dependencies using Composer:

        composer install


4. Copy the .env.example file to a new file named .env:

        cp .env.example .env

5. Update the .env file with your database credentials and other settings.

       DB_CONNECTION=pgsql
       DB_HOST=yellow_media_db
       DB_PORT=5432
       DB_DATABASE=yellow_media
       DB_USERNAME=devuser
       DB_PASSWORD=devsecret

6. Run the Docker Compose docker-compose up.

7. Go inside a docker container:

       docker exec -ti yellow_media_test_app bash
    
execute command:

       php artisan migrate

## API Endpoints
- [POST] /api/user/register: Register new user.
fields: first_name [string], last_name [string], email [string], password [string], phone [string]
- [POST] /api/user/sign-in: Login.
- [POST] /api/user/recover-password
- [GET] /api/user/companies: show the company, associated with the user (by the relation)
- [POST] /api/user/companies: add the companies, associated with the user (by the relation)

All POST requests require ~Bearer~ authentication helea with a token, which can be obtained when registering or logging in a user


## Conclusion
This test Lumen 9 app serves as a basic starting point for building a RESTful API for managing users and companies using Lumen 9. You can use this app as a reference or build upon it to create more complex applications.



