# Changelog

All notable changes to **ShareX Media Server** will be documented in this file.

## v1.2

Text file support has been added! It's now possible to:

-   Upload text files via the API via the `/api/texts` route
    -   Four new API scopes have also been added which are required for API tokens to interact with the uploaded text files via the API.
-   View uploaded text files via the dashboard
-   View text files directly
    -   When clicking on the "view" button via the dashboard you'll be taken to a page with code highlighting to view the contents of the file, you can also add `/raw` to the URI to get the raw contents of the file with no formatting.
-   Delete text files
-   Customize files show per page via the control panel
-   Customize how long uploaded files are stored via the control panel

Besides support for text file uploads, a few spelling mistakes have also been fixed.

> The text file upload icons used on the dashboard is provided by [PKief/vscode-material-icon-theme](https://github.com/PKief/vscode-material-icon-theme), and the code highlighting when viewing uploaded text files are provided by [highlight.js](https://highlightjs.org/)

## v1.1

User management support has been added to the control panel, it's now possible to:

-   Create new users.
-   Update existing users name, email, and passwords.
-   Delete users, along with all their data (image uploads).
-   Impersonate users to view their image uploads.
    -   It's not possible to edit the user while impersonating them, this is done so the user sessions, 2FA settings, and other sensetive data isn't accessable by anyone other than the user it belongs to.

> The user magement section also comes with search that filters by users names and emails.

The app layout also now have a footer with some helpful information, and all the PHP composer dependencies has been updated.

## v1.0

The application have been completely rewritten using [Laravel 8](https://laravel.com/), [Jetstream](https://jetstream.laravel.com/2.x/introduction.html), [Livewire](https://laravel-livewire.com/), and [TailwindCSS](https://tailwindcss.com/).

The application should have all the same functionalities as the old version media server with the exception of user management, however image uploads, thumbnails generations, and image management is supported, and in a lot better way then it used to be.
