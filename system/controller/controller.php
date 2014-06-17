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

class Controller
{
  
  private $paranoia;
  private $params;
  
  public function __construct($params)
  {
    $this->params = $params;
    $this->paranoia = Dependency::inject('Paranoia');
  }
  
  public function params($key)
  {
    if (isset($this->params['params'][$key])) {
      return $this->paranoia->sanitize($this->params['params'][$key]);
    }
    else {
      return null;
    }
  }

  public function helper($helper)
  {
    Dependency::inject('Helper')->load($helper);
  }

}

// EOF