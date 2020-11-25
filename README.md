# laravel-rpg

GraphQL Api for RPG purpose ( Players, Zones, Monsters & Pets, Recipes ... )

Developed for my entertainment, I personnally use it with my Node's Discord Bot on my Docker stack and for learning Gridsome. 

I develop it by reproducing the features available in the video games that I appreciate (Golden Sun, Pokemon, FF, Onimusha Tactics ...).

Without the real wish to recreate a game, the mechanics and the data structures fascinate me more than the result. If it works it's cool but I prefer to imagine the unfinished data flows ...

tested with MySQL, MariaDB and PostgreSQL

## Install
`composer require ezamlinux/rpg`

Use `php 7.4` and `Laravel ^8`

# Use
(required) publish the graphQL Schema: `php artisan vendor:publish --tag="rpg-graphql"`

Add - `mix.js('vendor/ezamlinux/rpg/resources/assets/js/rpg.js', 'public/js')` in your webpack.mix file ( I haven't found a better way for the moment )

Default access by `/rpg` prefix

If you extends Model, publish the config file :

`php artisan vendor:publish --tag="rpg-config"`

and edit the 'models' and / or 'morphMaps' array (edit the graphQL schema too)

## Commands available
For database initialisation : `php artisan migrate`

For dummy insertion : `php artisan rpg:inject`

## Note
In postman, think about using `Accept: application/json` Header to prevent troubleshoot on api usecase
