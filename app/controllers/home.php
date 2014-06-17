<?php

class Home_Controller extends PhelpsFramework\Controller {
  
  public function __construct()
  {
    self::helper('link');
  }
  
  function index()
  {
    
    return get_defined_vars();
  }
  
}