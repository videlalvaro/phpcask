<?php

class PHPCask
{
  protected $link;
  
  public function __construct($node, $cookie)
  {
    $this->link = peb_connect($node, $cookie);
    if(!$this->link)
    {
      throw new Exception(sprintf("Can't connect to node: %s with cookie: %s", $node, $cookie));
    }
  }
  
  public function put($key, $value)
  {
    $x = peb_encode("[~b, ~b]", array(array($key, $value)));
    $result = peb_rpc("php_cask", "put", $x, $this->link);
    return peb_decode($result);
  }
  
  public function get($key)
  {
    $x = peb_encode("[~b]", array(array($key)));
    $result = peb_rpc("php_cask", "get", $x, $this->link);
    return peb_decode($result);
  }
  
  public function delete($key)
  {
    $x = peb_encode("[~b]", array(array($key)));
    $result = peb_rpc("php_cask", "delete", $x, $this->link);
    return peb_decode($result);
  }
  
  public function list_keys()
  {
    $x = peb_encode("[]", array(array()));
    $result = peb_rpc("php_cask", "list_keys", $x, $this->link);
    return peb_decode($result);
  }
  
}
?>