# Launchpad App

This app keeps track of Growbot rankings by parsing the Growbot output and storing it in a database.

## Installation

* Install Laravel
* Fill out the .env file
* Run `php artisan migrate`

## Add a ranking

Go to slack, write to Growbot:
```
stats all
```

Copy the output, paste it into the form and save. The new ranking should be saved in the database.