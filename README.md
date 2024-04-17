# Board Game App
## Overview
I am building a web app that works as a way to log board games in your collection. It is a project that I'm using to help me learn how to use the Laravel PHP framework as it is such a popular framework currently. Some functionality that I am working to put in are basic CRUD actions for board games in a collection, being able to 'favourite' a game, adding notes or comments to board games that can be displayed publically to other users or private comments for personal use, logging game sessions with other users and more.

## Tech Stack
- PHP
- Laravel
- React.js

## Progress
Being new to Laravel I have used the Laravel Breeze set up initially with Blade templates to get things going. Breeze handily sets up user registration and log in functionality and it was interesting learning how to integrate this into the functionality I wanted to add. I learnt about setting up model relationships and in particular I have a Many to Many relationship between the board game model and users model. 
After developing the project to a point where I could do all the expected CRUD actions, as well as add games as 'favourites' and add comments, I decided to change the front end to React rather than the Blade templates (I have done this in the inertia-react branch of the project for now). This was much more difficult and certainly set me back a bit whilst trying to work out how to adapt the functionality that Laravel has set up so directly with the blade templates into the React way of doing things.
