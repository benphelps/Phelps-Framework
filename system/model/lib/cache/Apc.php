<?php
namespace ActiveRecord;

class Apc
{
  
  public function flush()
  {
    return apc_clear_cache('user');
  }
  
  public function read($key)
  {
    return apc_fetch($key);
  }
  
  public function write($key, $value, $expire = 0)
  {
    return apc_store($key, $value, $expire);
  }
  
}
?>