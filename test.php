<?php

require_once('./doc/examples/PHPCask.class.php');

function test_log($msg)
{
  echo "===============\n";
  echo $msg, "\n";
}

test_log("connecting…");
$phpcask = new PHPCask('phpcask@localhost', $argv[1]);
test_log("put…");
var_dump($phpcask->put("foo", "bar"));
test_log("get…");
var_dump($phpcask->get("foo"));
test_log("put…");
var_dump($phpcask->put("foo2", "bar2"));
test_log("list_keys…");
var_dump($phpcask->list_keys());
test_log("delete…");
var_dump($phpcask->delete("foo"));
test_log("get…");
var_dump($phpcask->get("foo"));
test_log("list_keys…");
var_dump($phpcask->list_keys());
