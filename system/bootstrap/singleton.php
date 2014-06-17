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
 * Singleton Trait
 *
 * Base singleton for which all singleton classes inherit.
 *
 * @author Ben Phelps
 */
trait Singleton {
  
  /**
   * Singleton instance container
   * 
   * @var obj $instance
   */
  private static $instance = null;
  
  /**
   * Private __construct to block instantiation  
   *
   * @return void
   */
  private function __construct() {
  }
  
  /**
   * Init method to get an instance of the class
   *
   * @return Singleton
   */
  public static function init() 
  {
    if (!isset(self::$instance)) {
      $class = __CLASS__;
      self::$instance = new $class;
      if (method_exists(self::$instance, '__init')) {
        self::$instance->__init(func_get_args());
      }
    }
    return self::$instance;
  }
  
  /**
   * Proxy
   *
   * @return Singleton
   */
  public static function getInstance()
  {
    return self::init();
  }
  
  /**
   * Proxy
   *
   * @return Singleton
   */
  public static function instance()
  {
    return self::init();
  }
  
  /**
   * Proxy
   *
   * @return Singleton
   */
  public static function get()
  {
    return self::init();
  }
  
}

//EOF