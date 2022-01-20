# Cars4Hire

Cars4Hire is a site to rent your car and rent other people's cars.

To run the site locally, do the following steps:
1. Open XAMPP Control Panel and start Apache and MySQL
2. In phpmyadmin, create a database named ```sewa_mobil```
3. Open command prompt and run ```composer install```
4. Run ```copy .env.example .env```
5. Run ```php artisan key:generate```
6. Run ```php artisan migrate:fresh --seed```
7. Run ```php artisan storage:link```
8. Run ```php artisan serve```

## Notes
Admin:
- E-mail: admin@gmail.com
- Password: admin123

The feature to search location through Google Maps by searching IP address' coordinates are not yet functional, as when the site is run locally, it receives local IP address. For now, the program is hardcoded to Google's IP address.

## Video
Youtube: https://youtu.be/mcCfb9Z4jhQ