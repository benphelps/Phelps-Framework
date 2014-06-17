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
 * Cache Adapter Interface
 *
 * @package PhelpsFramework
 */
abstract class CacheAdapter {

  abstract public function read($key);
  abstract public function write($key, $value, $expire = 0);
  abstract public function info();
  abstract public function flush();
  
}

// EOF