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

spl_autoload_register(function ($class) {
    if (!class_exists($class, false)) {
      $class_file = explode('_', $class)[0];
      $class_file = APP_DIR . 'controllers/' . $class_file . '.php';
      if (file_exists($class_file)) {
        require_once($class_file);
      }
    }
});

foreach (glob(APP_DIR . 'config/*.php') as $file) {
  if(!is_dir($file)) require($file);
}

foreach (glob(APP_DIR . 'traits/*.php') as $file) {
  if(!is_dir($file)) require($file);
}