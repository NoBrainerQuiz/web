//var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

var express  = require('express');
var app      = express();
var socketIO = require('socket.io')
server = app.listen(3000)
var io = socketIO(server)

redis.subscribe('questions', function(err, count) {
  console.log('testiung')
});

//Issue with web sockets
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
    io.emit()
});

//Fix for sessions: https://laracasts.com/discuss/channels/laravel/broadcasting-event-to-specific-client
io.on('connection', function(clientCon) {
    console.log('connection')
})
