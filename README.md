## About the project

The card game is a ESL teaching aid designed to make the online teaching and learning of vocabulary, word associations, and sentence building more interactive and fun. 
It consists of a set of cards with different words in them. To setup the game, these cards can be organised into stacks and the user can select what words go in these cards from a set of lists of words categorised into parts of speech (nouns, verbs, adjectives, pronouns, etc).
Different variations of the game exist. eg. 'Complete the sentence', 'Make it plural', 'Construct a sentence in the future/past tense', etc.
The game setup includes a dice that can be used to randomise some prompts, and a timer to give the users some control on how long some tasks should take.

-----
About the repo:
This is a Laravel application that uses Inertia.js and Vue.js. I set it up with the Laravel Breeze Starter Kit.
It uses MySql database, tailwind and sass.

## Local Setup

-   Node 20

To serve it locally, you'll need to run

```sh
composer install
npm install
```

php artisan migrate:fresh --seed

Start the server

```sh
php artisan serve
```

Start vite

```sh
npm run dev
```

Login with

-   test@example.com
-   secret123

Testing

```sh
./vendor/bin/phpunit
```

```sh
npm test
```

## Comments

Currently in progress
