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


class Router
{
  
  public function __construct()
  {
    $this->config = Dependency::inject('Config');
    $this->routes = [];
    $this->default_controller = $this->config->get('default_controller');
    $this->path_info = $this->path_info();
  }
  
  private function path_info()
  {
    $uri = $_SERVER['REQUEST_URI'];
    preg_match(
      '/(?<path>.*)\??(?<query>.*)?/',
        preg_replace(
          '/\/index\.php/', '', $uri, 1
        )
    , $match);
    $this->path_info = $match['path'];
    return $match['path'];
  }
  
  public function register($routes)
  {
    foreach ($routes as $route => $resolution) {
      $regex = preg_replace([
        '#[\:|\!](\w+)#',
      ],[
        '(?<$1>[a-zA-Z0-9_\X]+)?',
      ], $route);
      $this->routes[$resolution] = "#^/$regex$#";
    }
  }
  
  private function format_params($array)
  {
    $return = [];
    foreach ($array as $key => $value) {
      if (!is_int($key)) {
        $return[$key] = $value;
      }
    }
    return $return;
  }
  
  public function parse()
  {
    
    // match empty route or default route
    if ($this->path_info == '/' || $this->path_info == '') {
      return new Route([
        'controller' => $this->default_controller,
        'view' => 'index',
        'params' => []
      ]);
    }
    
    // match custom routes
    // this has a precendence issue that users would need to be aware of
    foreach ($this->routes as $resolution => $regex) {
      if (preg_match($regex, $this->path_info, $matches) == 1) {
        preg_match('#(?<controller>\w+)\#(?<view>\w+)#', $resolution, $resolution_match);
        return new Route([
          'controller' => $resolution_match['controller'],
          'view' => $resolution_match['view'],
          'params' => $this->format_params($matches)
        ]);
      }
    }
    
    // match default routes
    if (preg_match('#(?<controller>\w+)/?(?<view>\w+)?/?(?<param>\w+)?#', $this->path_info, $matches)) {
      $controller = (!empty($matches['controller'])?$matches['controller']:$this->default_controller);
      $view = (!empty($matches['view'])?$matches['view']:'index');
      $route = new Route([
        'controller' => $controller,
        'view' => $view,
        'params' => $this->format_params(['id' => (!empty($matches['param'])?$matches['param']:false)])
      ]);
      return $route;
    }
    
    // something went wrong
    
    $route = new Route([
      'controller' => $this->default_controller,
      'view' => 'index',
      'params' => ['error' => 'failed to parse route']
    ]);
    return $route;
    
  }

}

// EOF