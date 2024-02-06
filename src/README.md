
## Task Manager Api

# Installation

- To get started, make sure you have Docker installed on your system, and then clone this repository.

- Check ports for docker-compose containers. Maybe you want to change some of them
 
  - By default: 
  - `nginx - :80
    mysql - :3306
    php - :9000
    redis - :6379
    mailhog - :8025`

- Next, navigate in your terminal to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build app`


- Run `docker-compose run --rm composer install`


- In some cases, you should go inside container with php and run `php artisan key:generate`
