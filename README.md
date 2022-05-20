<div id="top"></div>

# RoadCube Store Api

Some instructions on how to use this Api created by Antonis Lilis.

Api is created in Laravel 9 framework and postgreSQL database.

# Summary

## Exercise Features
1) I have created migration for the fields that are required for the 'stores' table.
2) The database schema that is used is postgreSQL.
3) The stores.json file which includes all stores in json format is imported in the database from the StoresTableSeeder class. Specifically we read the file content and we save it automatically in the "stores" table.
4) I have created a Store Controller, Model, Validations on Http\Requests folder.
5) For the search functionality (stores filtering) I created a Filter functionality you can find inside the "Filters" folder. Each parameter has its filter. The coordinates filter includes the lat, lon and radius fields that are all mandatory for an area range search.
6) For the logging I created a custom solution. The middleware "RequestLoggerMiddleware" makes the job inside the terminate function. Specifically i use this mw on the store routes. Each time a store request is finished we save some basic log data in the database inside the "logs" table. I have created the LogController and Log Model. 
7) I have created some tests for the stores and log functionality. 

## More features

### Users - Auth
I have created an auth functionality with jwt token. You can register, login, logout users. 

Users have roles and permissions that you can find in the database or inside database migration/seeder files.

There are 4 more endpoints for the auth.

### Stores
I have added 2 more endpoints, one to get all stores and one to create a store.

### Rights
Some routes are protected with permissions. For example if you want to see the logs or delete them you need admin rights.
The same if you want to create a store.

### Other
For the model functionality I used Repositories. You can find the implementation on the "Repositories" folder and inside controllers. 

All routes are protected with a custom XSS middleware, so to protect database from XSS attacks.

Other middlewares are created like to check permissions, roles, send responses if user doesn't have the access rights for an action.


# INSTRUCTIONS

## Table of contents
* [Download Project](#download-project)
* [Install Dependencies](#install-dependencies)
* [Create Database](#create-database)
* [Environment File](#environment-file)
* [Run Server](#run-server)
* [Database Migration](#database-migration)
* [Testing Api With Postman](#testing-api-with-postman)
* [Api Endpoints](#api-endpoints)
* [Issues / Solutions](#issues-and-solutions)

## Installation and test the Api

Be sure that you will follow the instructions below


## Download Project

### Via Zip File
If you want to setup the project from the zip file you just have to extract this from roadCubeApi.zip
in a folder of your choice

### Via Git Repository
In case you want to clone the project from Git [repository](https://github.com/antonislilis/roadcubeApi) just do the following
At first make sure that you have installed the git on your machine
```
Create a folder of your choice
Inside the empty folder type

> git init
> git clone https://github.com/antonislilis/roadcubeApi.git
```

## Install Dependencies
Now the project is in your folder. 
It's time to install dependencies. Make sure that you have installed the [composer](https://getcomposer.org/). 

To install project required dependencies type the following command:
```python
> composer install
```
Now the vendor folder has been created.
The project has been installed.

## Create Database
This project is using PostgreSQL database schema

Make sure that you have the PostgreSQL installed.

Create a database in the postgreSQL named "roadcube" or a name of your choice ( You can define this later in the .env file)

###!!! In case that the filtering on search request sends an sql state error maybe you need to run in postgreSQL the following commands in console
CREATE EXTENSION cube;

CREATE EXTENSION earthdistance;

## Environment File

### !!! This step can be avoided if you got the project from the zip file.
Inside the roadCubeApi.zip file there is a file named .env

Copy this file directly to the project root folder.

Now you can see something like:

![img.png](storage/app/public/img.png)

Here you have to write your database name, password, host etc. In this .env file case, are some default values.

## Run Server
In order to start a laravel server run the following command
```python
> php artisan serve
```
Now the laravel dev server should be running and by default the host is http://127.0.0.1:8000


## Database Migration
Once you finish with the database connection, is time to add the tables and some data in our database

To do this type:

```python
> php artisan migrate:fresh --seed
```

If everything goes as expected you will see something like

![img_1.png](storage/app/public/img_1.png)

Great! The database is filled with tables and data.




## Testing Api With Postman

Inside the roadCubeApi.zip there is a collection and environment for Postman. Import those files in Postman
and you will be able to have all endpoints and global variables in order to test the api.
[Instructions on how to setup and import collection in postman](https://developer.ft.com/portal/docs-start-install-postman-and-import-request-collection)


## Api Endpoints

### Stores
Endpoints for the Stores. 

The api/store/search is the required endpoint for the exercise. Other store endpoints is to get all stores and create a new store. 
To create a new store you need admin rights.

```  
  1) GET api/store/all -> No parameters
      ( It returns all stores )
      
      
  2) GET api/store/search -> parameters [ name, app_name, address, lat, lon, radius ]  
      ( search stores with filtering by name, app_name, address, coordinates( lat, lon, radius) )
      
      Example request = api/store/search?name=Roadcube&lat=34.0107300&lon=23.7495600&radius=200
      
      
  3) POST api/store/create -> Json Payload
      Need authentication. Only Admins or other roles with the permission stores.create can create a store 
      
      Example Payload 
      {
        "parent_id": 1,
        "store_type_id": 1,
        "name": "Test",
        "app_name": "Test App",
        "address": "test test",
        "zip": "12222",
        "email": "test.test@test.com",
        "lat": 35.0107300,
        "lon": 25.7495600
      }
      
  
```

### Auth Routes
Endpoints for authentication (login, register, logout, get current user data)

```
 1) POST api/auth/signin -> Json Payload
     
     Example payload for admin login
     {
        "email": "admin@admin.net",
        "password": "12345678"
    }
    Example payload for user login
     {
        "email": "user@user.net",
        "password": "12345678"
    }

 2) GET api/auth/user -> No parameters
    Get the data for the logged in user
    
    
 3) POST api/auth/signout
    Logout the user  
    
 4) POST api/auth/register -> Json Payload
    Register a user  
   
   Example payload
   {
    "email": "test4@test.gr",
    "name": "test",
    "password": "12345678",
    "password_confirmation": "12345678"
    }
```

### Admin - Log Routes
Endpoints for the log functionality (get all Logs, clear all logs).
Admin routes are accessible only for logged users that have the admin role and also the permission
"account_type = admin"

```
 1) GET api/admin/logs -> No parameters
    Get all logs from database
    
 2) DELETE api/admin/logs/delete
    Delete all logs in database
```

## Run Tests
To run the tests just type
```
> php artisan test
```
All test should pass.

## Issues and Solutions

There are some issues will may face in the project setup that are mentioned above.
In summary:

1) Laravel 9 version require 8.0.2 php version and above, so be sure that your machine is running a proper version.
2) When you will run the api/store/search request you may see an SQL error. That means that you have not enabled 2 extensions on your postgreSQL. Go to the postgres query console and run:
```
CREATE EXTENSION cube;

CREATE EXTENSION earthdistance;
```
3) Be sure that the composer dependencies are installed successfully. In case that something is going wrong try to delete the **_vendor_** folder and the **_composer.lock_** file. Run again the **_"composer i"_** command.
4) If the database migration and seed command returns sql error make sure that you made the database connection correctly. Check the database name, host, password, driver etc on the **_.env_** file.
