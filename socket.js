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

redis.subscribe('test-channel', function(err, count) {
  console.log('testiung')
});

redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

io.on('connection', function(clientCon) {
    console.log('connection')
})
