<p align="center"><img src="https://image.ibb.co/b9a4gw/nobrainer.png">
</p>

<p align="center">
   <a href="https://travis-ci.org/NoBrainerQuiz/web" target="_blank"><img src="https://travis-ci.org/NoBrainerQuiz/web.svg?branch=master" alt="Build Status"></a>
   <a href="https://scrutinizer-ci.com/g/NoBrainerQuiz/web/" target="_blank"><img src="https://scrutinizer-ci.com/g/NoBrainerQuiz/web/badges/quality-score.png?b=master" alt="Build Status"></a>
<a href="https://scrutinizer-ci.com/g/NoBrainerQuiz/web/" target="_blank"><img src="https://scrutinizer-ci.com/g/NoBrainerQuiz/web/badges/code-intelligence.svg?b=master" alt="Code Intelligence"></a>

   <hr />
</p>

<p align="center"><img src="https://goo.gl/dUPhKZ" /></p>

## NoBrainer ##

**NoBrainer is an online real-time quiz application written in PHP & NodeJS. It's built with [Laravel](https://laravel.com)  & [Socket.io](https://socket.io/).**

It's goal is to be:

* **Simple**, it's easy to use & packed full of features
* **Powerful**, Everything is in real-time, host unlimited quizzes for unlimited users.
* **Responsive**, a mobile focused UI optimised for touch devices, with an included dedicated mobile app!

## System Requirements
> **NoBrainer is currently in development, so please expect bugs and potential unexpected behaviour**.

 - PHP >= 7.1.3
 - NodeJS >= 8.10.0
 - Redis >= 3.0.5
 - MySQL >= 5.5
 - Composer
 - NPM
 - Currently tested on Apache & NGINX

Once you have successfully installed all of NoBrainer's dependencies you can move on to the installation steps.

## Installation

**Clone the repository to your local machine**
```bash
$ git clone https://github.com/NoBrainerQuiz/web.git NoBrainer
```
```bash
$ cd NoBrainer
```
**Create .env and enter details**
```bash
$ cp .env.example .env
```

**Install dependencies**
```bash
$ composer install && npm install
```

**Run migrations, seed database and starting the server**
```bash
$ php artisan migrate
```
```bash
$ php artisan db:seed
```
**If using the laravel server run**
```bash
$ php artisan serve
```

**Configure MySQL***
```
Download a MySQL server.
Make the database by doing: create database nobrainer;

```

**Setting up your .env file and MySQL**

```
Make sure all of the settings are the same in your file:

BROADCAST_DRIVER=redis

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nobrainer
DB_USERNAME=<username you made when installing MySQL>
DB_PASSWORD=<password you made when installing MySQL>

Open the file /app/Sockets/database.js and set the username and password for the MySQL to the same as above.
```

**Starting Sockets and Redis (Redis needs installing beforehand)**
```bash
$ redis-server
```
```bash
$ node socket
```

> Go to  http://127.0.0.1:8000/pin and enter 9876, then enter your desired username.

> Then to start the quiz go to http://127.0.0.1:8000/quiz/start/9876 (on a seperate browser)

> **Brief Installation video by UP805717: ** https://youtu.be/rxy6xUXWi68  ([Youtube Link](https://youtu.be/rxy6xUXWi68))

## Development Team

| Name        | Role          |
| ------------- |:-------------:|
| [Kent55](https://github.com/Kent55) - UP821309       | Core Development
| [springjben](https://github.com/springjben) - UP805717      | Core Development      
| [GlennHS](https://github.com/GlennHS) - UP824726 | UI Development      
| [jamesdavy21](https://github.com/jamesdavy21) - UP804392 | Mobile Development  
