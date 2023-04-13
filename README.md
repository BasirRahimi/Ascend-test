<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Ascend Tech Test

Backend scaffolding for a Library application with the following functionalities:
1. Users can see books in their Library and borrow/return books (one at a time currently, this should be changed to mass borrow/return in a future version).
2. Admins can manage books.
3. The application is closed off meaning currently no Third party can use our Api routes, this may be changed depending on requirements.

### Notes
I made use of laravel breeze vue in order to setup authentication scaffolding and register a user.
I tested my Models via Tinker however given more time I could implement feature tests for the methods defined in Book and Library controller.

### Tinker
If you'd like to use laravel tinker please:
1. `composer install`
2. `php artisan migrage`
3. `php artisan db:seed`
4. `php artisam serve`

Now in a seperate terminal

1. `npm install`
2. `npm run dev`

- Now in your browser visit the local website and create an account / register.
- You'll find the url in your artisan serve terminal
- Now you can stop npm run dev and artisan dev if you wish, it's doesn't need to be running to tinker.
- Within your terminal run `php artisan tinker`.