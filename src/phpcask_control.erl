-module(phpcask_control).

-export([start/0, stop/0]).

start() ->
  application:start(phpcask).

stop() ->
  application:stop(phpcask).