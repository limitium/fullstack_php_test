Fullstack test task
===================
Task description https://docs.google.com/document/d/1OsgSsScUmeSIqf1J537coCIa7NdB42V7JQ05oZi-mAE/edit#

### Deployment

#### 1. Clone project
#### 2. Install backend dependencies
```sh
$ composer install --working-dir=./backend
```
#### 3. Load fixtures
```sh
$ php backend/app/console doctrine:fixtures:load
```
#### 4. Check tests
```sh
$ phpunit -c backend/app/
```
#### 5. Install fronted dependencies
```sh
$ npm install
```
#### 6. Build frontend and start server
```sh
$ gulp
```

