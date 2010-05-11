-module(phpcask).

-behaviour(gen_server).

-export([start/0, start_link/0, stop/0]).

-export([init/1, handle_call/3, handle_cast/2, handle_info/2,
  terminate/2, code_change/3]).

-export([get/1, put/2, delete/1, list_keys/0, merge/0]).

start() -> gen_server:start({local, ?MODULE}, ?MODULE, [], []).
start_link() -> gen_server:start_link({local, ?MODULE}, ?MODULE, [], []).
stop()  -> gen_server:cast(?MODULE, stop).

-record(state, {ref, dirname, expiry_secs}).

get(Key) -> gen_server:call(?MODULE, {get, Key}).
  
put(Key, Value) ->
  gen_server:call(?MODULE, {put, Key, Value}).
  
delete(Key) ->
  gen_server:call(?MODULE, {delete, Key}).
  
list_keys() ->
  gen_server:call(?MODULE, {list_keys}).
  
merge() ->
  gen_server:call(?MODULE, {merge}).

init([]) -> 
  Dirname = get_dirname(),
  Bitcask = bitcask:open(Dirname, [read_write]),
  {ok, #state{ref=Bitcask, dirname=Dirname, expiry_secs=get_expiry_secs()}}.

handle_call({get, Key}, _From, #state{ref=Bitcask}=State) ->  
  Reply = 
  case bitcask:get(Bitcask, Key) of
    {ok, Value} -> binary_to_term(Value);
    _ -> not_found
  end,
  {reply, Reply, State};

handle_call({put, Key, Value}, _From, #state{ref=Bitcask}=State) ->
  Reply = bitcask:put(Bitcask, Key, term_to_binary(Value)),
  {reply, Reply, State};

handle_call({delete, Key}, _From, #state{ref=Bitcask}=State) ->
  Reply = bitcask:delete(Bitcask, Key),
  {reply, Reply, State};

handle_call({list_keys}, _From, #state{ref=Bitcask}=State) ->
  Reply = bitcask:list_keys(Bitcask),
  {reply, Reply, State};
  
handle_call({merge}, _From, #state{dirname=Dirname, expiry_secs=Expire}=State) ->
  Options = [{expiry_secs, Expire}],
  bitcask:merge(Dirname, Options),
  {reply, ok, State}.

handle_cast(stop, State) -> {stop, normal, State}.
handle_info(_Info, State) -> 
  error_logger:info_msg("handle_info ~p ~p.~n", [_Info, State]),
  {noreply, State}.
terminate(_Reason, _State) -> ok.
code_change(_OldVsn, State, _Extra) -> {ok, State}.

get_dirname() ->
  "./data".

get_expiry_secs() ->
  900.