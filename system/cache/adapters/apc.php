<?php
/**
 * 
 *
 * @author Ben Phelps
 * @version 0.2
 * @copyright 2012 benphelps.me
 * @package PhelpsFramework
 **/

/**
 * @package PhelpsFramework;
 */
namespace PhelpsFramework;

/**
 * Simple Cache Class
 *
 * @package PhelpsFramework
 * @author Ben Phelps
 */
class CacheAPC extends CacheAdapter {

  public function read($key)
  {
    return apc_fetch($key);
  }
  
  public function write($key, $value, $expire = 0)
  {
    return apc_store($key, $value, $expire);
  }
  
  public function info()
  {
    return apc_cache_info('user');
  }
  
  public function flush()
  {
    return apc_clear_cache('user');
  }

}