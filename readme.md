# ShareX Media Server

_ShareX Media Server_ is an app made to support sharing images, files, and text snippets from [ShareX](https://getsharex.com/), built using [Laravel](https://laravel.com/), [Livewire](https://laravel-livewire.com/), and [TailwindCSS](https://tailwindcss.com/).

> Files and Text snippets are not yet supported, but will be supported in the near future.

## Table of Content

- [Prerequisites](#prerequisites)
- [Installing ShareX Media Server](#prerequisites)
  - [Installing Laravel](#installing-laravel)
  - [Setting up queue workers](#setting-up-queue-workers)
  - [Setting up application assets](#setting-up-application-assets)
  - [Default login credentials](#default-login-credentials)
- [Setting up ShareX](#setting-up-sharex)
  - [Creating an API token](#creating-an-api-token)
  - [Custom ShareX Uploader](#custom-sharex-uploader)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [License](#License)

## Prerequisites

- Apache2 / Nginx
- [Yarn](https://yarnpkg.com/)
- [Composer](https://getcomposer.org/)
- Node >= v10.15
- PHP >= v7.3
  - BCMath PHP Extension
  - Ctype PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension
  - GD PHP Extension

## Installing ShareX Media Server

### Installing Laravel

The app utilizes [Composer](https://getcomposer.org/) for installing the PHP dependencies, and [Yarn](https://yarnpkg.com/) for installing the node dependencies, to get started you'll first need to clone down the repository.

    git clone https://github.com/Senither/ShareX-Media-Server.git .

Next go into the `ShareX-Media-Server` folder, first we'll setup the PHP side of the project, to do this install all the dependencies using [Composer](https://getcomposer.org/)

    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

Then rename and setup your environment variables by renaming the `.env.example` file to `.env` and adding in your settings.

Next we'll need a unique application key, Laravels artisan helper makes this super easy, just run:

    php artisan key:generate

We're now ready to migrate our database, this will create all the tables required for the application.

    php artisan migrate

Next we'll need to make sure that the application can read all the required files, and write to the places where files will be generated later when the app is in-use, the easiest way to do this is by setting the storage and bootstrap cache directories to permission level 777.

    chmod -R 777 storage
    chmod -R 777 bootstrap/cache

Now we'll need to setup our cronjobs for the application, this will allow the app to run tasks like the cleanup task outside of the users request, so we can ensure files are deleted when they should be, this can be done by setting up a cronjob to run the `artisan schedule:run` command, start by opening the crontab file.

    crontab -e

Next, add a new cron command at the bottom of the file that runs every minute.

    * * * * * php /path/to/your/ShareX-Media-Server/artisan schedule:run

### Setting up queue workers

Next, we'll need to set up a supervisor to run and manage our queues, the queues are used for generating thumbnails, and processing other tasks that would otherwise take awhile to be completed, start by installing the supervisor package:

    sudo apt-get install supervisor

> You can skip this step if you have set the `QUEUE_CONNECTION` environment variable in the `.env` file to `sync`, setting it to `sync` will run the tasks that would otherwise have been queued right as they're called.

Supervisor configuration files are typically stored in the `/etc/supervisor/conf.d` directory. Within this directory, you may create any number of configuration files that instruct supervisor how your processes should be monitored. For example, let's create a `media-server-worker.conf` file that starts and monitors a `queue:work` process:

```ini
[program:media-server-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/ShareX-Media-Server/artisan queue:work --sleep=3 --tries=5
autostart=true
autorestart=true
user=<username>
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/your/ShareX-Media-Server/worker.log
stopwaitsecs=3600
```

In this example, the `numprocs` directive will instruct Supervisor to run two `queue:work` processes and monitor all of them, automatically restarting them if they fail, you should be fine with a single process if the site is being hosted for a small number of people. You should replace the `<username>` with the username of the account that should run the queued jobs.

Once the configuration file has been created, you may update the Supervisor configuration and start the processes using the following commands:

```
sudo supervisorctl reread

sudo supervisorctl update

sudo supervisorctl start media-server-worker:*
```

The entire server side should now be setup and ready to be used!

### Setting up application assets

Next we'll need to build all of the front-end resources so users can view and use the website, this can be done using [Yarn](https://yarnpkg.com/).

    yarn install

This will install all the node modules required to build our assets, if Yarn is not installed you can use `npm install` instead, after all the node modules are installed we can build our assets.

    yarn prod

This will build and compile all our assets for a production environment, different environment builds can also be used, like `dev` for development mode, or `watch` for watch mode, which will re-build all the assets anytime any changes are made to the files.

The entire app should now be setup!

### Default login credentials

You can try visit the site in your browser, if everything is setup correctly you should be presented with a login screen, you can login using the credentials below as an admin user.

- **Username:** admin@admin.com
- **Password:** password

You can also edit the `config/fortify.php` file and uncomment `Features::registration()` on line 135 to enable user registration on the site, however do note that this means anyone can make an account, users created through the registration form are regular users and won't have access to the control panel, however they can upload images, files, and text snippets through the API using ShareX.

## Setting up ShareX

### Creating an API token

Before you start, you'll first need to create an API token that can be used with ShareX requests, the API token is used to validate your image, file, and text snippet uploads, to ensure you're actually allowed to upload files.

To create an API token you can click on your account name in the navigation in the top right of the app, and then click on the `API Tokens` menu item, this should move you to a page where you can create your own token, from there give the token a name, and make sure that you tick the upload permissions so the API token has the permissions to upload files to the media server.

![ShareX Media Server - Creating an API token](ShareX-create-api-token.png 'ShareX Media Server - Creating an API token')

After clicking on `Create` you'll get a popup with your newly created API token, make sure to copy it so you have it for later, since it won't ever be shown to you again.

### Custom ShareX Uploader

To setup a custom ShareX uploader you can navigate to: _Destinations_ -> _Custom Uploader Settings_ in the ShareX app.

From there create a new custom uploader, to setup everything we have to do a few things.

1. Set the request method to `POST`.
2. Set the URL to the root of your media server, followed by the API endpoint for the type of uploader you're setting up, example `/api/images` for images.
3. Add an `Authorization` header to the request, and set the value to `Bearer <your API token>`
4. Set the "File from name" value to match what you're uploading, for images it would be `image`.
5. Finally, click on the `response` tab, select the JSON option and set the URL to `$json:resource_url$`, this will select the resource URL being generated by the API during the upload and make it available to you so you can copy it to your clipboard.

It should all look something like this.

#### Request page

![ShareX - Custom Uploader Request](ShareX-custom-uploader-request.png 'ShareX - ShareX - Custom Uploader Request')

#### Response page

![ShareX - Custom Uploader Response](ShareX-custom-uploader-response.png 'ShareX - ShareX - Custom Uploader Response')

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

#### License

The ShareX Media Server open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
