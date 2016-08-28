# Pivotal Tracker notification channel for Laravel 5.3

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/pivotal-tracker.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/pivotal-tracker)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/pivotal-tracker/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/pivotal-tracker)
[![StyleCI](https://styleci.io/repos/66170357/shield)](https://styleci.io/repos/66170357)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/pivotal-tracker.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/pivotal-tracker)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/pivotal-tracker/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/pivotal-tracker/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/pivotal-tracker.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/pivotal-tracker)

This package makes it easy to create stories using [pivotal-tracker](https://www.pivotal-tracker.com/help/api) with Laravel 5.3


## Contents

- [Installation](#installation)
	- [Setting up the pivotal-tracker service](#setting-up-the-pivotal-tracker-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/pivotal-tracker
```

## Usage

Now you can use the channel in your via() method inside the notification:
    
    use NotificationChannels\pivotal-tracker\pivotal-trackerChannel;
    use NotificationChannels\pivotal-tracker\pivotal-trackerMessage;
    use Illuminate\Notifications\Notification;
    
    class AnApplicationEvent extends Notification
    {
        public function via($notifiable)
        {
            return [pivotal-trackerChannel::class];
        }
    
        public function topivotal-tracker($notifiable)
        {
           return (new pivotal-trackerMessage('Something just occurred!'))
                       ->description('This is a test for a notification via Pivotal Tracker.')
                       ->type('bug')
                       ->labels(['a_chore', 'just_a_test']);
        }
    }

In order to let your Notification know which pivotal-tracker user and project you are targeting, add the routeNotificationForpivotal-tracker method to your Notifiable model.

This method needs to return an array containing the access token of the authorized Pivotal Tracker user and the project ID to add the story to.

    public function routeNotificationForpivotal-tracker()
    {
        return [
            'token' => 'NotifiableToken',
            'projectId' => 'Thepivotal-trackerProjectID'
        ];
    }



### Available methods
                                      
* `name('')`: Accepts a string value for the story name.
* `description('')`: Accepts a string value for the story description.
* `type('')`: Accepts a string value for the story type (feature|bug|chore)
* `labels([])`: Accepts an array of strings representing the story labels. 
  * Alternatively you can pass the labels as arguments.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email nbourguig@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Nassif Bourguig](https://github.com/nbourguig)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
