# Mini Send
A small email prototype.

## Description
*Mini Send* consists of to separate applications. One Vue2 Frontend and one Laravel Backend.
These app were designed together with the purpose of offering a simple platform from which to send emails and view some statistics about them.

## Installation
### Backend (minisend_service)

#### .env
Make a copy of the **.env.example** file in the same folder and call it **.env**.

Enter your Database and SMTP values for these keys:
```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
and
```
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
```

#### Composer
```
composer install 
```

#### Auth
```
php artisan jwt:secret
```
*P.S.: If you don't seed your database you will need to create a new User yourself.*

#### Artisan
```
php artisan migrate --seed // If you want some testing data
php artisan serve // To start the service
```

### Frontend
#### .env
Create a new **.env** file in your minisend_app folder. Add the following line:
```
VUE_APP_API_URL=http://localhost:8000/api/
```

#### Yarn
```
yarn
yarn serve
```

#### Authentication
If you seeded the database, the correct user credentials are already filled in.
If you did not seed the database you will have to remove those values and fill in your own.

Authentication is session-based. So you will be logged out if you reload the page.
