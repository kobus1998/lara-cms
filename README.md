## NOTE: this project is in a very early stage, the earliest stage actually.

# lara-cms
A cms build using the PHP framework Laravel.

## Setup / contributing
- Fork the repository.
- Clone the just forked repository.
- Set the main repository upstream.
- Copy the .env.example and rename it to .env.
- Edit the .env file.
- Run npm install
- Run composer install
- Migrate the database
- run npm run watch for client side
- run php artisan serve for back-end
- You're done with the setup! :tada: :rocket:

## Todo's
### Important
- Generate a theme with a command.
- CRUD for pages, content, modules and types.
- Somehow make a layout (still need to find out how to do some things).
- Fix database (I have a feeling I've forgot something).
- Write tests.
### Less important
- Pretty and user-friendly front-end for the dashboard.
- Adding Webpack paths towards the themes.
- Webpack should not put all files into one file.
- Maybe even get rid of Webpack and just switch to Gulp(?).
- Write documentation for developer & client.
- Language files.
### Not important
- Add Google analytics to the dashboard instead of making my own one.
- Add Google ads to your site.
- Add Google Maps to your site.

### A theme includes
 * app.css
 * app.js
 * modules
   * header-content.json
   * footer-content.json
   * ads.json
 * includes
   * _header.php
   * _base.php
   * _footer.php
 * layouts
   * layout1.php
   * layout2.php

