## Installation

* Clone the repo ` git clone https://gitlab.com/sandidian/stti-stieni-api.git `
* `cd ` to project folder. 
* Run ` composer install `
* Save as the `.env.example` to `.env` and set your database information 
* Run ` php artisan key:generate` to generate the app key
* Run ` php artisan migrate --seed` 
* Run ` php artisan passport:install` 
* Run ` php artisan db:seed --class=IndoRegionSeeder`
* Done !!!
