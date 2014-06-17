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

class Helper {
  
  public function __construct()
  {
    $this->paranoia = Dependency::inject('Paranoia');
    $this->config = Dependency::inject('Config');
  }
  
  public function autoload()
  {
    $autoload = $this->config->get('autoload_helpers');
    foreach ($autoload as $helper) {
      $this->load($helper);
    }
  }
  
  public function load($helper)
  {
    if (file_exists(SYS_DIR . 'helper/helpers/' . $helper . '.php')) {
      include(SYS_DIR . 'helper/helpers/' . $helper . '.php');
      return true;
    }
    elseif(file_exists(APP_DIR . 'helpers/' . $helper . '.php')) {
      include(APP_DIR . 'helpers/' . $helper . '.php');
      return true;
    }
    else {
      return false;
    }
  }
  
}