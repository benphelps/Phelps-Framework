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

class Route {
  
  public function __construct(array $route_array)
  {
    
    $this->paranoia = Dependency::inject('Paranoia');
    
    // make sure we have a proper route
    $this->sanity($route_array);
    
    // just forward params
    $this->params = $route_array['params'];

    $this->class = $this->format_controller($route_array['controller']);
    $this->controller = $route_array['controller'];
    $this->method = $this->paranoia->sanitize($route_array['view']);
    $this->view = $route_array['view'];
    
    // check validity of the controller
    if ($this->controller_exists()) {
      if (!class_exists($this->class)) {
        // file exists, class does not, file is wrong
        Error::fatal('' . $this->controller . '.php is malformed, class ' . $this->class . ' can not be found.');
      }
    }
    else {
      // file doesn't exist
      Error::fatal(
        '' . $this->controller . '.php can not be found.<br><br>'.
        '<strong>File does not exists in any of the following locations:</strong><br>'.
        ''.APP_DIR . 'controllers/' . $this->controller .'.php'
      );
    }
    
    // check validity of the method / view
    
    if (!method_exists($this->class, $this->method)) {
      Error::fatal('Controller has no method ' . $this->method . '');
    }
    
    // make sure the view exists before we fire off
    ((new View($this->controller, $this->method, []))->view_exists());

  }
  public function format_controller($controller)
  {
    $controller = $this->paranoia->phpize($controller);
    return ucfirst($controller) . '_Controller';
  }
  private function sanity($route_array)
  {
    if ( isset($route_array['controller']) && isset($route_array['view']) ) {
      return true;
    }
    Error::fatal('Route array is malformed, please report this to a developer.');
  }
  private function controller_exists()
  {
    $class_file = APP_DIR . 'controllers/' . $this->controller . '.php';
    if (file_exists($class_file)) {
      return true;
    }
    return false;
  }
}

// EOF