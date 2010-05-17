<?php

require_once('./PHPCask.class.php');

class PHPCaskSessionHandler
{
  protected $host;
  protected $erlang_cookie;
  
  protected $phpcask = null;
  
  public function __construct($host, $cookie)
  {
    $this->host = $host;
    $this->erlang_cookie = $cookie;
  }
  
  public function open($save_path, $session_name)
  {
    $this->phpcask = new PHPCask($this->host, $this->erlang_cookie);
  }
  
  public function close()
  {
    $this->phpcask->close();
  }
  
  public function read($session_id)
  {
    $data = $this->phpcask->get($session_id);
    return $data[0] == 'not_found' ? '' : $data[0];
  }
  
  public function write($session_id, $session_data)
  {
    $result = $this->phpcask->put($session_id, $session_data);
    return $result[0] == 'ok';
  }
  
  public function destroy($session_id)
  {
    $result = $this->phpcask->delete($session_id);
    return $result[0] == 'ok';
  }
  
  public function gc($max_expirte_time)
  {
    $result = $this->phpcask->merge($max_expirte_time);
    return $result[0] == 'ok';
  }
}
?>