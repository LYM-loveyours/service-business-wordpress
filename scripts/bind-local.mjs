// Restrict the Playground CLI's HTTP listener to loopback (its upstream default is all interfaces).
import { Server } from 'node:net';
const original = Server.prototype.listen;
Server.prototype.listen = function (...args) {
  if (typeof args[0] === 'number') {
    if (typeof args[1] !== 'string') args.splice(1,0,'127.0.0.1');
    else args[1]='127.0.0.1';
  } else if(args[0] && typeof args[0] === 'object' && 'port' in args[0]) {
    args[0]={...args[0],host:'127.0.0.1'};
  }
  return original.apply(this,args);
};
