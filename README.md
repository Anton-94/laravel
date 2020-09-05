### Installation

1. Clone this repository:

        git clone https://github.com/Anton-94/Laravel.git
        
2. Rename .env.example to .env
3. Run `docker-compose up` for start docker containers.
4. Run `docker-compose run php-cli bash` command for enter to `php-cli` container.
5. Run `composer install` for install dependencies.
6. Install migrations:
       
       php artisan migrate
       
7. Generate app key:
        php artisan key:generate
      
That's all.

Now you can launch the app at this `http//:localhost:8005` address

To run chat, use `http://localhost:8005/chat` address 
