const express = require('express');
const { isPlainObject } = require('lodash');
const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*" }
});
io.on('connection', (socket) => {
    console.log('user connected');

    socket.on('message.send', (message) => {
        //console.log(message);
        // io.sockets.emit('message.send', message);
        socket.broadcast.emit('message.send', message);
    });

    socket.on('disconnect', () => {
      console.log('user disconnected');
      count--;
    });

  });

server.listen(3000, () => {
    console.log('server successfully running');
});
