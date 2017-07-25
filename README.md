## NOTE: this project is in a very early stage.

# lara-cms.
A cms build using the PHP framework Laravel.

## The thought behind it.
I want to make it easier for developers when dealing with complicated clients (You know what I mean, the clients that want something differently everyday). This means a lot of things will be reusable and editable. Also I wanted to step back from the blog site thinking. This usually doesn't help the developers when working on a information providing site instead of a typical blog site. This project is mainly for myself but it's MIT anyway. Maybe people will like this idea and I'll make it easier to use, but for now it's just a personal project.

## What I try ending up with.
Create a page. Add as many text fields as you want to it. You can add content groups. Maybe your pages just needs a title, a text area and a image. Simply make a content group with those fields and add the content group to the page.

Modules will be rendered into every page. You could add contact info or social media info into a module and make a footer that way. You will also get all page names with url rendered into every page so you can automate the navigation.

I will focus on analytics in a later stage. I might just add a easy way to use google analytics instead of making it myself. But I will see once I'm there.

Your client will have less power over the cms, that way they can't fuck up their site. There are multiple roles. First of we have admin, that role can do everything. Then we have moderator. The moderator focuses on other users. And then we have writer, the writer can add and edit the content. That will most likely be your clients role.

## Setup / contributing.
- Fork the repository
- Clone the just forked repository
- Set the main repository upstream
- Copy the .env.example and rename it to .env
- Edit the .env file
- Run npm install
- Run composer install
- Migrate the database
- run npm run watch for client side
- run php artisan serve for back-end
- You're done with the setup! :tada: :rocket:
