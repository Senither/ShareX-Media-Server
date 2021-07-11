# Changelog

All notable changes to **ShareX Media Server** will be documented in this file.

## v1.8 - 2021-07-11

* Added support for previewing files.
    - Added icons for video and audio file previews.
    - Added background icon to file previews.
    - Added preview URL to API responses for files.
    - Added support for previewing PDF files.
    - Added support for previewing archive files (ZIP and Jar files).
    - Added support for accessing files directly
        - This requires that you setup the storage link, this can be done by running `php artisan storage:link`.
    - Fixed default file icon showing the correct icon.
    - Fixed file previews working on extra small devices.
* Changed calculating used disk space job.
    - The job is now scheduled anytime any files are uploaded or deleted, along with when files expire and are removed from the media server.
* Fixed text upload form setting file extension correctly for some files.
* Fixed file uploads setting file extension correctly for some files.
* Fixed some spelling mistakes.
* Changed 2FA QR code to make it easier to scan in dark mode.
* Refactored code to follow default [Larastan](https://github.com/nunomaduro/larastan) rules.
    - A GitHub workflow was also created to ensure all code in the future also follows the rules.
* Upgraded Laravel to 8.49.2 along with other PHP and Node dependencies.

## v1.7 - 2021-06-27

* Added support for uploading generic files was added.
* Added info button for text previews.
* Added used disk space to the dashboard stats.
* Changed formatting of all the blade views.
* Forced text preview scroll bar to the bottom of the screen.
* Installed [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper) to make development easier.
* Refactored the codebase to use PSR-12 instead of PSR-12.
* Refactored all the blade views to follow the same formatting.
* Upgraded Laravel to 8.40.0 along with other PHP and Node dependencies.

## v1.6 - 2021-03-31

* Added stats cards to the dashboard.
* Added fallback route that redirects 404 error pages to the dashboard.
* Added version check to the footer.
    - The system will check what version the application is running, and add a message if the media server instance is out of date, you can customize how often the system checks versions in the `config/version-comparison.php` config file.
* Upgraded to Laravel 8.35.1 along with other PHP dependencies.
    - Reordered some methods to follow the new TLint styling rules that was applied when updating TLint.

## v1.5 - 2021-03-21

* Added support for uploading images, text files, and shortening URLs via the dashboard.
* Set trusted proxies to trust all traffic
    - This is done so Livewire can upload files files on the dashboard behind services like CloudFlare.
* Added Linting using [PHP CodeSniffer](https://github.com/FriendsOfPhp/PHP-CS-Fixer) and [TLint](https://github.com/tighten/tlint).
* Fixed user theme swap working when going from dark to light mode.
* Made upload API scopes be enabled by default.
* Moved setup guides to the github wiki pages.
* Removed redits from the example environment variable.

## v1.4 - 2021-03-09

* Added support for shortening URL was added.
    - The shorten URL service will always pick the shortest domain you have registered if multiple domains are registered under the control panel.
* Support for viewing and deleting short URLs via the dashboard.
* Grouped media resource settings under tabs.
* Improved image loading.
    - All images on the site are now lazy loaded, this should help lower the bandwidth on mobile devices since images not shown on the screen are no longer loaded.
* Optimized JS assets.
    - Unused JS packages have been removed to help reduce the file size of JS files.
* Fixed some spelling mistakes.
* Updated Laravel to 8.32 along with some other PHP and Node dependencies.

## v1.3 - 2021-03-07

* Added dark theme support
    - Users can no select if they want to use a light or dark version of the site on the profile page, and site administrators can control the default theme used globally on the site, including login, register, and password reset pages.
* Added random URL generator
    - This generator just betweens the other generators at random.
* Added update bash script to make it easier to update the app in the future.
* Improve validation checks for text uploads.
* Upgraded to Laravel 8.30+

## v1.2 - 2021-03-02

Text file support has been added! It's now possible to:

* Upload text files via the API via the `/api/texts` route
    - Four new API scopes have also been added which are required for API tokens to interact with the uploaded text files via the API.
* View uploaded text files via the dashboard
* View text files directly
    - When clicking on the "view" button via the dashboard you'll be taken to a page with code highlighting to view the contents of the file, you can also add `/raw` to the URI to get the raw contents of the file with no formatting.
* Delete text files
* Customize files show per page via the control panel
* Customize how long uploaded files are stored via the control panel

Besides support for text file uploads, a few spelling mistakes have also been fixed.

> The text file upload icons used on the dashboard is provided by [PKief/vscode-material-icon-theme](https://github.com/PKief/vscode-material-icon-theme), and the code highlighting when viewing uploaded text files are provided by [highlight.js](https://highlightjs.org/)

## v1.1 - 2021-02-25

User management support has been added to the control panel, it's now possible to:

* Create new users.
* Update existing users name, email, and passwords.
* Delete users, along with all their data (image uploads).
* Impersonate users to view their image uploads.
    - It's not possible to edit the user while impersonating them, this is done so the user sessions, 2FA settings, and other sensetive data isn't accessable by anyone other than the user it belongs to.

> The user magement section also comes with search that filters by users names and emails.

The app layout also now have a footer with some helpful information, and all the PHP composer dependencies has been updated.

## v1.0 - 2021-02-24

The application have been completely rewritten using [Laravel 8](https://laravel.com/), [Jetstream](https://jetstream.laravel.com/2.x/introduction.html), [Livewire](https://laravel-livewire.com/), and [TailwindCSS](https://tailwindcss.com/).

The application should have all the same functionalities as the old version media server with the exception of user management, however image uploads, thumbnails generations, and image management is supported, and in a lot better way then it used to be.
