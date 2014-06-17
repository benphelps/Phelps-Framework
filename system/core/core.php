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

class Core
{
  
  public function __construct()
  {
    // inject dependencies
    $this->config = Dependency::inject('Config');
    $this->router = Dependency::inject('Router');
    $this->helper = Dependency::inject('Helper');
    
    $this->load_ar();
    $this->helper->autoload();
    $this->process_request();
  }
  
  private function load_ar()
  {
    $ar_config = \ActiveRecord\Config::instance();
    $ar_config->set_model_directory(APP_DIR . 'models');
    $ar_config->set_connections($this->config->get('database'));
    $ar_config->set_logger(new Logger);
    $ar_config->set_logging(true);
    $ar_config->set_cache("apc://null", ['expire' => 300]);
  }
  
  private function process_request()
  {
    
    $this->request = new Canister;                      # Create a canister
    $this->request->set([                               
      'route' => $this->router->parse()                 # to hold the route info
    ]);
     
    $class = $this->request->route->class;
    $params = [
      'params' => $this->request->route->params,
      'get' => $_GET,
      'post' => $_POST
    ];
    
    $this->method_call =                                # Store the results
    call_user_func([                                    # of the call to
      new $class($params),                              # the controller
      $this->request->route->method                     # view method
    ]);
    
    $this->view = (new View(                            # Init the view
      $this->request->route->controller,                # of the controller
      $this->request->route->method,                    # view method
      [                                                 
        'controller' => $this->method_call,             # insert the controller results
        'framework' => [                                
          $params                                       # and params
        ]
      ]
    ))->load_view();                                    # then pass to the view
  }

}

// EOF