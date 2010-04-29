# PHPCask #

PHPCask is client for the Bitcask K/V Store recently released by [Basho](http://blog.basho.com/2010/04/27/hello,-bitcask/)

On the PHP side it requires the [PHP Erlang Bridge Extension](http://code.google.com/p/mypeb/)

Note that this client is *very* simple. It's aim is to showcase what can be done with the PHP Erlang Bridge Extension and with Bitcask from PHP.

## Running The Tests ##

Open the Terminal and type:

    > cd path/to/bitcask/ebin
    > erlc path/to/phpcask/php_cask.erl
    > erl -sname phpcask
    
Inside the erlang CLI:
    
    > php_cask:start().
    
Open another Terminal window and type:

    > cd path/to/phpcask/
    > php test.php erlang_cookie
    
You can read the test.php file to see how does it works. 

*erlang_cookie* must be the value of the Erlang Cookie used by the node running Bitcask.

# TODO #

* Improve error handling
* Implement the complete Bitcask API
* Add more test
* Fork this project and improve it _that's you :)_