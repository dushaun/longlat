# LongLat

Quick address api in Laravel

### Installation & Setup
This project was developed in the PHP framework Laravel, the best way to run it is through its dedicated dev environment called Valet.

Valet requires macOS and [Homebrew](http://brew.sh/). Before installation, you should make sure that no other programs (such as Apache or Nginx) are binding to your local machine's port 80.

To get Valet up and running, you should do the following:

* Install or update Homebrew to the latest version using ```brew update```.
* Install PHP 7.2 using Homebrew via ```brew install homebrew/php/php72```.
* Install Valet with [Composer](https://getcomposer.org/) via ```composer global require laravel/valet```. Make sure the  ```~/.composer/vendor/bin``` directory is in your system's "PATH".
* Run the ```valet install``` command. This will configure and install Valet and DnsMasq, and register Valet's daemon to launch when your system starts.

Next, [download](https://github.com/dushaunac/longlat) or clone the project into a designated dev folder such as ```~/Sites```. That folder will be the one that Valet "parks" itself to serve the project website. To do this, you will need to do the following:

* In terminal ```cd ~/Sites``` and run ```valet park```. This command will register your current working directory as a path that Valet should search for sites.
* Next, ```cd longlat/``` to run ```valet link```, following with ```valet secure```
* Once that's done, run ```valet domain app```, to designate a TLD. Then we can run ```valet links``` to check our domain for the project
* To check that Valet is working open ```https://longlat.app``` in your browser to see if it is serving.
* If Valet is working, continue with the setup steps below. Otherwise, refer to the offical [Valet documentation](https://laravel.com/docs/5.6/valet)

You will now need to setup the database to complete the project setup. If you do not have a preferred database try MariaDB by running ```brew install mariadb``` on your command line. Once MariaDB has been installed, you may start it using the ```brew services start mariadb``` command. You can then connect to the database at ```127.0.0.1``` using the ```root``` username and an empty string for the password.

My preferred database client is [Sequel Pro](https://www.sequelpro.com/) to access and interact with database, but to setup the database for the project in terminal:

* Enter ```mysql -uroot``` to get into MySQL.
* Next, enter ```mysql> CREATE DATABASE longlat;``` to setup the database.
* Finally, run ```php artisan migrate```. Laravel will then setup the tables on the database for the project.

Once this has been completed, create a ```.env``` file from the ```.env.example``` file that is provided. Everything should be in place, but you'll need to provide an API key for the ```GOOGLE_MAPS_API_KEY``` environment variable required for looking up address coordinates. You can look to obtain an API Key quickly [here](https://developers.google.com/maps/documentation/geocoding/start?csw=1&authuser=1).

The project setup is now complete and ready for use.

That should be it. Now you should be able to launch the website to use the features required for this challenge. If you get stuck on any part of this installation process, please have a look at the documentation:

* [Laravel Valet](https://laravel.com/docs/5.6/valet)
* [Homebrew](http://brew.sh/)
* [Composer](https://getcomposer.org/doc/)
* [MySQL](http://dev.mysql.com/doc/mysql-getting-started/en/)

## API Interaction

Here are a few details on the API created in this mini app, I would suggest using something like [Postman](https://www.getpostman.com/) to interact with it properly and easily.
| Domain | Method    | URI                     | Name | Action                                          | Middleware |
|--------|-----------|-------------------------|------|-------------------------------------------------|------------|
|        | GET/HEAD  | api/property            |      | App\Http\Controllers\PropertyController@index   | api        |
|        | POST      | api/property            |      | App\Http\Controllers\PropertyController@store   | api        |
|        | GET/HEAD  | api/property/{property} |      | App\Http\Controllers\PropertyController@show    | api        |
|        | PUT/PATCH | api/property/{property} |      | App\Http\Controllers\PropertyController@update  | api        |
|        | DELETE    | api/property/{property} |      | App\Http\Controllers\PropertyController@destroy | api        |

### GET
```https://longlat.app/api/property```

### CREATE
```https://longlat.app/api/property```
#### Body
```
address_line_1:
address_line_2:
city:
postcode:
```

### SHOW
```https://longlat.app/api/property/{property}``` - ```{property}``` represents the ID of the property

### UPDATE
```https://longlat.app/api/property/{property}``` - ```{property}``` represents the ID of the property
#### Body
```
address_line_1:
address_line_2:
city:
postcode:
```

### DELETE
```https://longlat.app/api/property/{property}``` - ```{property}``` represents the ID of the property