<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Installation

#### `git clone ...`

after a fresh clone of the project.

#### `cd folder-path`


## Install dependencies

#### `composer install`

#### then let's generate app key.


#### `php artisan key:generate`

## Storage link
First remove storage in public folder 
#### `php artisan storage:link`

  
## Configure your .env variables in (database etc...)

`.env`

#### **Local**

#### `php artisan config:cache`



#### `php artisan migrate --path=database/migrations/* --seed`

Install node dependencies and configure


## Opren terminal in project folder
`npm install && npm run dev`

## open another terminal in project folder
`php artisan serve`

### Don't forget to configure permissions

If you face laravel storage link permission denied. So, this tutorial will help you to give permission for linking public storage directory in laravel app.

It turns out I was missing a view directories in laravel_root/storage/. In order to fix this, all I had to do was:

`cd {laravel_root}/storage`
`mkdir -pv framework/views app framework/sessions framework/cache`
`cd ..`
`chmod 777 -R storage`
`chown -R www-data:www-data storage`

Then, You need to adjust the permissions of storage and bootstrap/cache.

`cd into your Laravel project.`
`sudo chmod -R 755 storage`
`sudo chmod -R 755 bootstrap/cache`


