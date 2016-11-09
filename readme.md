# Launchpad App
![Launchpad App dashboard displaying the current ranking, latest props as well as opening times](.github/preview.png)

This app logs when our coworking space called Launchpad is open/closed. It also reads our slack channel and mimics the behavior of Growbot, i.e. reading `props @user for cleaning up`.

## Installation

* Fork the repo
* Clone it onto your pc
* Install the dependencies with Composer
* Fill out the .env file (ask [@lorey](https://github.com/lorey) for API keys)
* Run `php artisan migrate` (or rather `php artisan migrate --seed` for development to get initial data)
* Import the first rankings

## Contribute
If you want to help or have any questions, you can find the developers in our slack in the #app channel:

[![Slack Status](https://launchpad-slack-inviter.herokuapp.com/badge.svg)](https://launchpad-slack-inviter.herokuapp.com)

Issues for beginners are marked with the tag `help wanted`: View all [issues for beginners](https://github.com/pioniergarage/launchpad-app/issues?q=is%3Aissue+is%3Aopen+label%3A%22help+wanted%22)

## Import props and update rankings
You have three options:

1. Add `* * * * * php /patch/to/project/artisan schedule:run >> /dev/null 2>&1` to cron for automatic imports every minute.
2. Import from terminal once by executing `php artisan schedule:run`.
3. Import from web by opening `http://{your-url}/slack`.
