<?php

require_once('./doc/examples/PHPCask.class.php');

$phpcask = new PHPCask('phpcask@localhost', $argv[1]);
var_dump($phpcask->put("foo", "bar"));
var_dump($phpcask->get("foo"));
var_dump($phpcask->put("foo2", "bar2"));
var_dump($phpcask->list_keys());
var_dump($phpcask->delete("foo"));
var_dump($phpcask->get("foo"));
var_dump($phpcask->list_keys());
