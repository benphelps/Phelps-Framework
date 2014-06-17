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
 * Memcache Cache Adapter
 *
 * @package PhelpsFramework
 * @author ActiveRecord
 */
class CacheMemcache extends CacheAdapter
{
  
  const DEFAULT_PORT = 11211;
  const DEFAULT_HOST = 'localhost';
  private $memcache;

  public function __construct($options)
  {
    $options = $options[0];
    $this->memcache = new \Memcache();
    
    $options['port'] = isset($options['port']) ? $options['port'] : self::DEFAULT_PORT;
    $options['host'] = isset($options['host']) ? $options['host'] : self::DEFAULT_HOST;
    
    if (!$this->memcache->connect($options['host'],$options['port']))
      throw new CacheException("Could not connect to $options[host]:$options[port]");
  }

  public function read($key)
  {
    return $this->memcache->get($key);
  }

  public function write($key, $value, $expire = 0)
  {
    $this->memcache->set($key, $value, null, $expire);
  }
  
  public function info()
  {
    return $this->memcache->getStats();
  }
  
  public function flush()
  {
    $this->memcache->flush();
  }

}