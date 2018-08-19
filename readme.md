## Laracart The Laravel Online Store
Laravel online store using laravel 5.6, Materialize-css 1.0.0rc-2, JQuery, Material icons, google fonts and etc.

### Let's get this application running
- Make sure you have [xampp](https://www.apachefriends.org/index.html) installed which is a package for PHP, MySQL, and Apache. it's available for all platforms such as windows, mac, and linux.

- Clone this repo to your machine or just download the zip.

- Install [Composer](https://getcomposer.org) first, then run this command in your command-line (you should be inside your project directory).

- Rename .env.example to .env and add you database, mail, and braintree credentials.

- Generate application key.
```bash
    php artisan key:generate
```
- create tables with migration command
```bash
    php artisan migrate
```

- Generate dummy data for products, category and admin account.
```bash
    php artisan db:seed
```

- Link the storage folder
```bash
    php artisan storage:link
```

- Clear the application cache
```bash
    php artisan config:clear
```

- you can create a virtual host or just run this command to run dev server
```bash
    php artisan serve
```

### Publish resources for Ckeditor
```bash
php artisan vendor:publish --tag=ckeditor
```

### Note
- This application uses [LaravelShoppingCart](https://github.com/Crinsane/LaravelShoppingcart) which is a laravel package that gives you all the cart features.