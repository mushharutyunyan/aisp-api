<p>Service can help you to calculate client debit/credit transactions</p>

## Installation

```bash
git clone https://github.com/mushharutyunyan/aisp-api.git
```
```bash
composer install
```
- create .env file in route folder and change database credentials
```bash
php artisan migrate --seed
```
```bash
run php artisan passport:client --password
```
  - What should we name the password grant client?
    - any name you want
  - Which user provider should this client use to retrieve users? [users]:
    - press enter
```bash
Password grant client created successfully.
Client ID: 945cbfe9-eb0b-4e59-91d0-d5ce74ac4a33
Client secret: aRX9QxACKr51QyUi0Hjc6kPb5q9CJedexgESVcpc
```

## API documentation

https://documenter.getpostman.com/view/2471754/U16jPRzy

## Sources
- PHP - Laravel framework
- https://laravel.com/docs/8.x/passport - for openBanking client authentication
- https://github.com/spatie/laravel-enum - for SQL enum columns
- https://github.com/veelasky/laravel-hashid - for SQL column hashing


