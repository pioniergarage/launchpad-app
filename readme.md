# Launchpad App
![The Launchpad App in action](.github/preview.png)

This app logs when our coworking space called Launchpad is open/closed. It also reads our slack channel and mimics the behavior of Growbot, i.e. reading `props @user for cleaning up`.

## Installation

* Clone the repo
* Install the dependencies with Composer
* Fill out the .env file (ask [@lorey](https://github.com/lorey) for API keys)
* Run `php artisan migrate`
* Import the first rankings

## Import props and update rankings
You have three options:
1) Add `* * * * * php /patch/to/project/artisan schedule:run >> /dev/null 2>&1` to cron for automatic imports every minute.
2) Import from terminal once by executing `php artisan schedule:run`.
3) Import from web by opening `http://{your-url}/slack`.