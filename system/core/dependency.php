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

class Dependency {
  
  use Singleton;
  
  private static $dependencies = [];
  private static $required = [
    'paranoia'
  ];
  
  private function __init()
  {
    // manually inject dependencies
    static::$dependencies['paranoia'] = new Paranoia;
  }
  
  public static function inject($class)
  {
    // Class Name
    $class = static::$dependencies['paranoia']->classify($class);
    // Fully Qualified Class Name
    $fqcn = '\\PhelpsFramework\\'.$class;
    // Lowercase Class Name
    $lccn = strtolower($class);
    
    if (isset(static::$dependencies[$lccn])) {
      if (static::$dependencies[$lccn] instanceof $fqcn) {
        return static::$dependencies[$lccn];
      }
      else {
        throw new DependencyException("Registry for ${lccn} is not an instance of ${fqcn}.");
      }
    }
    else {
      try {
        static::$dependencies[$lccn] = new $fqcn;
        return static::$dependencies[$lccn];
      }
      catch(Exception $e) {
        throw new DependencyException("Error creating instance of ${fqcn}.<br>" . $e->getMessage());
      }
    }
  }
  
}

// auto init the class
Dependency::init();
