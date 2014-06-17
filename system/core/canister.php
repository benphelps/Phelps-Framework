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


/**
 * An object based registery class, key/values are stored as public class variables.
 *
 * @package PhelpsFramework
 */
class Canister
{
  
  
  function __construct($construct = false)
  {
    if ($construct) {
      $this->set($construct);
    }
  }
  public function __set($key, $value)
  {
    $this->$key = $value;
  }
  public function __get($key)
  {
    if (isset($this->$key)) {
      return $this->$key;
    }
    else {
      $trace = debug_backtrace();
      trigger_error('Attempting to access a non-existent canister key \''.$key.'\' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
    }
  }
  public function __isset($key)
  {
    return isset($this->$key);
  }
  public function __unset($key)
  {
    unset($this->$key);
  }
  public function set($array)
  {
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $this->$key = new Canister($value);
      }
      else {
        $this->$key = $value;
      }
    }
  }
  public function __toString()
  {
    $info = new ArrayObject($this);
    return 'Canister containing ' . $info->count() . ' keys';
  }
}

// EOF