<p align="center"><img src="https://image.ibb.co/b9a4gw/nobrainer.png">
</p>

<p align="center">
   <a href="https://travis-ci.org/NoBrainerQuiz/web" target="_blank"><img src="https://travis-ci.org/NoBrainerQuiz/web.svg?branch=master" alt="Build Status"></a>
   <a href="https://scrutinizer-ci.com/g/NoBrainerQuiz/web/" target="_blank"><img src="https://scrutinizer-ci.com/g/NoBrainerQuiz/web/badges/quality-score.png?b=master" alt="Build Status"></a>
   <hr />
</p>

<p align="center"><img src="https://goo.gl/dUPhKZ" /></p>

## NoBrainer ##

**NoBrainer is an online real-time quiz application written in PHP & NodeJS. It's built with [Laravel](https://laravel.com)  & [Socket.io](https://socket.io/).**

It's goal is to be:

* **Simple**, it's easy to use & packed full of features
* **Powerful**, Everything is in real-time, host unlimited quizzes for unlimited users.
* **Responsive**, a mobile focused UI optimised for touch devices, with an included dedicated mobile app!


## Installation

> **NoBrainer is currently in development, so please expect bugs and potential unexpected behaviour**.

NoBrainer requires **PHP >= 7.1.3** and you will also need to install [Composer](https://getcomposer.org) & [NPM](https://www.npmjs.com).

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

**Run migrations and seed database**
```bash
$ php artisan migrate
```
```bash
$ php artisan db:seed
```

**Starting Sockets and Redis (Redis needs installing beforehand)**
```bash
$ redis-server --port 3000
```
```bash
$ node socket.js
```

> **To test emails locally set MAIL_DRIVER to log in your .env file**.

## Development Team

| Name        | Role          |
| ------------- |:-------------:|
| [Kent55](https://github.com/Kent55) - UP821309       | Core Development
| [springjben](https://github.com/springjben) - UP805717      | Core Development      
| [GlennHS](https://github.com/GlennHS) - UP824726 | UI Development      
| [jamesdavy21](https://github.com/jamesdavy21) - UP804392 | Mobile Development  
