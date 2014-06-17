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

class Config
{
  
  public $config;
  
  public function __construct()
  {
    $this->config = [];
  }
  
  public function set($config)
  {
    foreach ($config as $key => $value) {
      $this->config[$key] = $value;
    }
  }
  
  public function get($key)
  {
    return $this->config[$key];
  }
  
}

// EOF