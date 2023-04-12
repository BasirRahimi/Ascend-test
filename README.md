<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Ascend Tech Test

Backend scaffolding for a Library application with the following functionalities:
1. Users can see books in their Library and borrow/return books (one at a time currently, this should be changed to mass borrow/return in a future version).
2. Admins can manage books.
3. The application is closed off meaning currently no Third party can use our Api routes, this may be changed depending on requirements.

### Notes
I made use of laravel breeze vue in order to register a user, which includes an ideal setup with Vite and Inertia.
I tested my functions via Tinker however given more time I could implement unit tests for the methods defined in Book and Library controller.

### Run the application
After cloning/pulling master please:
1. `composer install`
2. `npm install`
3. `npm run dev`
4. In a seperate terminal `php artisan serve`
