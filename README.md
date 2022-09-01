
----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git@github.com:rumanod/address_book.git

Switch to the repo folder

    cd address_book

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
Copy the example env file and make the required configuration changes in the .env.testing file

    cp .env .env.testing   

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

----------

# Code overview

## API calls avail:

    GET:
        http://localhost:8000/api/person/{name} --> Gets person by their name (firstname, lastname or combo)
        http://localhost:8000/api/personemail/{email} --> Gets person by their email (any string will be matched)
        http://localhost:8000/api/persongroup/{name} --> Gets people in a group by group name (any string will be matched)
        http://localhost:8000/api/groupsperson/{peopleid} --> Gets groups a person is in by people id
        
    POST:
        http://localhost:8000/api/person
            params: firstname:James
                    lastname:Sinclair
                    emails[0]:James@gmail.com
                    emails[1]:James2@gmail.com
                    phonenos[0]:0621446172
                    phonenos[1]:0641765012
                    addresses[0]:8A Jonod Street, CA, 7681
                    addresses[1]:15 Follow Street, PG 
                    groupname:Testgoup
        
        http://localhost:8000/api/group 
            params: name:Testgoup                

----------

# Testing API

Run the laravel development server

    php artisan serve
    ./vendor/bin/phpunit
    
 ----------

# Completion: 7 hours
