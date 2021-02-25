# Changelog

All notable changes to **ShareX Media Server** will be documented in this file.

## v1.1

User management support has been added to the control panel, it's now possible to:

  - Create new users.
  - Update existing users name, email, and passwords.
  - Delete users, along with all their data (image uploads).

> The user magement section also comes with search that filters by users names and emails.

The app layout also now have a footer with some helpful information, and all the PHP composer dependencies has been updated. 

## v1.0

The application have been completely rewritten using [Laravel 8](https://laravel.com/), [Jetstream](https://jetstream.laravel.com/2.x/introduction.html), [Livewire](https://laravel-livewire.com/), and [TailwindCSS](https://tailwindcss.com/).

The application should have all the same functionalities as the old version media server with the exception of user management, however image uploads, thumbnails generations, and image management is supported, and in a lot better way then it used to be.
