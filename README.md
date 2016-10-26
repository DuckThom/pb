[![StyleCI](https://styleci.io/repos/71285308/shield?branch=master)](https://styleci.io/repos/71285308)

# PastaBin 
A pastebin service made with Lumen

### Manual setup

Copy the example docker-compose file
- `cp docker-compose.yml.example docker-compose.yml`

Change its values
- `editor docker-compose.yml`

Build the containers
- `docker-compose build`

Start the containers
- `docker-compose up -d`

Go to the Lumen app directory
- `cd app`

Install the composer modules
- `composer install`

Install the node modules
- `npm install`

Compile/copy the css/js files
- `node_modules/.bin/gulp`

Copy the example .env file
- `cp .env.example .env`

Change its values
- `editor .env`

### Automatic setup

Soon™
- `envoy run setup`
