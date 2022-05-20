<div id="top"></div>

# RoadCube Store Api

Some instructions on how to use this Api created by Antonis Lilis

## Table of contents
* [Download Project](#download-project)
* [Create Database](#create-database)
* [Setup](#setup)

## Installation and test the Api

Be sure that you will follow the instructions below


## Download Project

If you want to setup the project from the zip file you just have to extract this from roadCubeApi.zip
in a folder of your choice

In case you want to clone the project from Git [repository](https://github.com/antonislilis/roadcubeApi) just do the following
At first make sure that you have installed the git on your machine
```
Create a folder of your choice
Inside the empty folder type

> git init
> git clone https://github.com/antonislilis/roadcubeApi.git
```
Now the project is on your folder. 
It's time to install dependencies. Make sure that you have installed the composer 

Type:
```python
> composer install
```
Now the vendor forder has been created
The project have been installed

## Create Database
This project is using PostgreSQL database schema

Make sure that you have the PostgreSQL installed.

Create a database in the postgreSQL named "roadcube" or a name of your choice ( You can define this later in the .env file)

## .env file
Inside the roadCubeApi.zip file there is a file named .env

Copy this file directly to the project root folder.

Now you can see something like:

![img.png](img.png)

Here you have to write your database name, password, host etc. In this .env file case, are some default values.

## Run dev server
In order to start a laravel server run the following command
```python
> php artisan serve
```

## Migrate and seed database
Once you finish with the database connection, is time to add the tables and some data in our database

To do this type:

```python
> php artisan migrate:fresh --seed
```

If everything goes as expected you will see something like

![img_1.png](img_1.png)

Great! The database is filled with tables and data.




## Testing the Api with Postman

Inside the roadCubeApi.zip there is a collection for Postman. Import this
and you will be able to have all endpoints in order to test the api.
[Instructions on how to setup and import collection in postman](https://developer.ft.com/portal/docs-start-install-postman-and-import-request-collection)


## Api Endpoints
```python
  Stores
  
  1) GET api/store/all -> No parameters
  ( It returns all stores )
  
  
  2) GET api/store/search -> parameters [ name, app_name, address, lat, lon, radius ]  
  ( search stores with filtering by name, app_name, address, coordinates( lat, lon, radius) )
  
  Example request = api/store/search?name=Roadcube&lat=34.0107300&lon=23.7495600&radius=200
  
  
  3) POST api/store/create -> Json Payload
  
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
