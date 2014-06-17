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
 * View base class.  Handles loading and displaying views.
 *
 * @package PhelpsFramework
 * @author Ben Phelps
 */

class View
{
  
  /**
   * Set values used elsewhere
   *
   * @param string $controller
   * @param string $method
   * @param array $params
   * @author Ben Phelps
   */
  public function __construct($controller, $method, array $params)
  {
    $this->controller = $controller;
    $this->method = $method;
    $this->params = $params;
  }
  
  /**
   * Search in pre-defined locations for a view file.
   *
   * @param string $file 
   * @return string|bool
   * @author Ben Phelps
   */
  private function find_ext($file)
  {
    $files[] = $file . '.html.php';
    $files[] = $file . '.php';
    $files[] = $file . '.html';
    $files[] = $file . '.tmpl';
    foreach ($files as $file) {
      if (file_exists($file)) {
        return $file;
      }
    }
    return false;
  }
  
  /**
   * Used to display errors when the search for the view failed.
   *
   * @param string $file
   * @return string
   * @author Ben Phelps
   */
  private function list_ext($file)
  {
    $files[] = $file . '.html.php';
    $files[] = $file . '.php';
    $files[] = $file . '.html';
    $files[] = $file . '.tmpl';
    $list = "";
    foreach ($files as $file) {
      $list .= $file . "<br>";
    }
    return $list;
  }
  
  /**
   * Returns the view file name or false on failure.
   *
   * @return string|bool
   * @author Ben Phelps
   */
  public function view_exists()
  {
    return $this->find_controller() !== false;
  }
  
  /**
   * Finds the controller view, or main view or fatal error on failure.
   * @todo Allow the controller to return or set an alternative view
   * @return string
   * @author Ben Phelps
   */
  private function find_controller()
  {
    $view_file = APP_DIR . 'views/' . $this->controller . '/' . $this->method . '';
    $view = $this->find_ext($view_file);
    if ($view) {
      return $view;
    }
    else {
      Error::fatal(
        'Unable to load controller view for ' . ucfirst($this->controller) . '_Controller::' . $this->method . '<br><br>' .
        '<strong>File does not exists in any of the following locations:</strong><br>'.
        $this->list_ext($view_file)
      );
    }
  }
  
  /**
   * Finds the global application.html template or false on failure.
   *
   * @return string|bool
   * @author Ben Phelps
   */
  private function find_global()
  {
    return $this->find_ext(APP_DIR . 'views/application/index');
  }
  
  /**
   * Searches pre-defined locations for a partial vie or fatal on failure.
   *
   * @param string $name 
   * @return string
   * @author Ben Phelps
   */
  private function find_partial($name)
  {
    $file = $this->find_ext(APP_DIR . 'views/application/'. $name);
    if ($file != false) {
      return $file;
    }
    
    $file = $this->find_ext(APP_DIR . 'views/'.$this->controller.'/' . $name);
    if ($file != false) {
      return $file;
    }
    
    Error::fatal(
      'Unable to load view for '. $name .'<br><br>' .
      '<strong>File does not exists in any of the following locations:</strong><br>'.
      $this->list_ext(APP_DIR . 'views/application/'. $name) .
      $this->list_ext(APP_DIR . 'views/'.$this->controller.'/' . $name)
    );
  }
  
  /**
   * Includes the global view only once into the document
   *
   * @return void
   * @author Ben Phelps
   */
  public function load_view()
  {
    include_once($this->find_global());
  }
  
  /**
   * Magic method to allow access to views via the $this param inside other views.
   * 
   * @todo This is quite ugly, perhaps use a method based method instead
   * @param string $__view 
   * @return void
   * @author Ben Phelps
   */
  public function __get($__view)
  {
    if (is_array($this->params['controller'])) extract($this->params['controller']);
    if (is_array($this->params['framework'])) extract($this->params['framework']);
    // all partials start with an _
    if ($__view[0] == '_') {
      include $this->find_partial($__view);
      return;
    }
    if ($__view === 'body') {
      include $this->find_controller();
      return;
    }
    return false;
  }

}

// EOF