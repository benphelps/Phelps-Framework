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
 * Bootstrap class to load core files
 *
 * @package PhelpsFramework
 * @author Ben Phelps
 */
class Bootstrap
{

  /**
   * Verify system directories and load classes
   *
   * @param array $classes An array of class files to include, excluding the file extension
   * @return void
   */
  public function __construct(array $classes)
  {
    $this->verify_dir();
    $this->init_load($classes);
  }
  
  /**
   * Load an array of class files
   *
   * @param array $classes An array of class files to include, excluding the file extension
   * @return void
   */
  private function init_load(array $classes)
  {
    foreach ($classes as $class) {
      $this->load($class);
    }
  }
  
  /**
   * Verify system directories
   *
   * @return void
   */
  private function verify_dir()
  {
    
    // impossible, could never happen really
    if (!is_dir(SYS_DIR) || SYS_DIR == '/') {
      throw new ConfigurationException('Could not find the system directory.');
    }
    
    if (!is_dir(APP_DIR) || APP_DIR == '/') {
      throw new ConfigurationException('Could not find the application directory.');
    }
    
    if (!is_dir(PUB_DIR) || PUB_DIR == '/') {
      throw new ConfigurationException('Could not find the public assets directory.');
    }
  }

  /**
   * Load a class file from the system directory
   *
   * @param string $class_file File to include, excluding .php extension
   * @return void
   */
  private function load($class_file)
  {
    $file = SYS_DIR . $class_file . '.php';
    if (!is_file($file)) {
      throw new FileNotFoundException("Unable to find required system file: ${file}", 1);

    }
    else {
      require_once($file);
    }
  }
  
}

//EOF