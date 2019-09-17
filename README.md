# PHP Developer assignment

## Task

Your task is to create a PHP application that is a feeds reader. The app can read feed from multiple sources and store them to database. Sample feeds http://www.feedforall.com/sample-feeds.htm.

## Requirements
- As a developer, I want to run a command which help me to setup database easily with one run.
- As a developer, I want to run a command which accepts the feed urls (separated by comma) as argument to grab items from given urls. Duplicate items are accepted.
- As a developer, I want to see output of the command not only in shell but also in pre-defined log file. The log file should be defined as a parameter of the application.
- As a user, I want to see the list of items which were grabbed by running the command line above, via web-based. I also should see the pagination if there are more than one page. The page size is a configurable value.
- As a user, I want to filter items by category name on list of items.
- As a user, I want to create new item manually via a form.
- As a user, I want to update/delete an item

## How to do
1. Fork this repository
2. Start coding. The application must be developed by using a PHP framework and follow coding standard of that framework. Using Symfony or Laravel is a plus.
3. Use git flow to manage branches on your repository
4. Open a pull request to `master` branch after done.
5. The implementation should covered by Unit Test or Functional Test.


# Documention

#### Setup local domain

cd base-php

```
sudo nano /etc/hosts
```

add line

127.0.0.1       lenguyenky.local

#### Setup env
```
cp lenguyenky/.env.example lenguyenky/.env
```
```
cp docker/.env.example docker/.env
```

```
cd docker
```

#### Start docker
```
docker-compose up -d
```

#### Exec to workspace
```
./dk ga
```

#### Setup laravel source

```
composer install
```
```
php artisan key:generate
```
```
php artisan migrate --seed
```

#### Link local

http://lenguyenky.local/

acccount default

admin@gmail.com
12345678

#### Link pgadmin

http://localhost:5050

account admin 

pgadmin4@pgadmin.org
admin

##### Create new server postgres

###### General
Name : <your_name>

###### Connection 
Host name/address: postgres
Port : 5432
Maintenance database: postgres
Username: none
