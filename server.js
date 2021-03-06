const express = require('express');
const { isPlainObject } = require('lodash');
const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*" }
});

var count = 0;
io.on('connection', (socket) => {

  // joined the chat
  socket.broadcast.emit('message.send', "A user has joined the chat");
  count++;
  io.emit("join.room", count);

  // disconnect the chat
  socket.on('disconnect', () => {
    io.emit("message.send", "A user has disconnect the chat");
    count--;
    io.emit("join.room", count);
  });

  socket.on('message.send', (message) => {
    io.emit('message.send', message);
  });

});

server.listen(3000, () => {
    console.log('server successfully running');
});
