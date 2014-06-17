<?php
/**
 * PhelpsFramework Core
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


class Cache
{
  
  use Singleton;
  
  /**
   * Array of known supported adapters.
   *
   * @var string
   */
  var $adapters = ['APC','FlatFile','Memcache', 'Xcache'];
  
  /**
   * Static handle for the adapter class
   */
  static $adapter = false;
  
  /**
   * Init the adapter and pass possible arguments to it
   *
   * @param string $args 
   * @return void
   */
  private function __init($args)
  {
    $adapter = (!empty($args[0])?$args[0]:'APC');
    if (!in_array($adapter, $this->adapters)) {
      throw new CacheException("Unable to load the cache adapter '${adapter}'");
    }
    
    $adapter_name = '\PhelpsFramework\Cache' . $adapter;
    self::$adapter = new $adapter_name((isset($args[1])?$args[1]:null));
  }
  
  /**
   * Read from the cache adapter
   *
   * @param string $key 
   * @return mixed
   */
  public static function read($key)
  {
    return self::$adapter->read($key);
  }
  
  /**
   * Write to the cache adapter
   *
   * @param string $key 
   * @param mixed $value 
   * @param int $expire 
   * @return bool
   */
  public static function write($key, $value, $expire = 0)
  {
    return self::$adapter->write($key, $value, $expire);
  }
  
  /**
   * Return info from the adapter
   *
   * @return array
   */
  public static function info()
  {
    return self::$adapter->info();
  }
  
  /**
   * Flush the adapters cache
   *
   * @return bool
   */
  public static function flush()
  {
    return self::$adapter->flush();
  }
  
}
