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
 * Error handler and thrower.
 *
 * @package PhelpsFramework
 * @author Ben Phelps
 */
class Error
{

  /**
   * List of textual representation of error levels
   *
   * @var array $levels Array of error levels
   */
  var $levels = [
    E_ERROR           =>  'Error',
    E_WARNING         =>  'Warning',
    E_PARSE           =>  'Parsing Error',
    E_NOTICE          =>  'Notice',
    E_CORE_ERROR      =>  'Core Error',
    E_CORE_WARNING    =>  'Core Warning',
    E_COMPILE_ERROR   =>  'Compile Error',
    E_COMPILE_WARNING =>  'Compile Warning',
    E_USER_ERROR      =>  'User Error',
    E_USER_WARNING    =>  'User Warning',
    E_USER_NOTICE     =>  'User Notice',
    E_STRICT          =>  'Notice',
  ];
  
  /**
   * Throws a fatal error and stops script execution
   *
   * @param string $errstr 
   * @return void
   * @author Ben Phelps
   */
  public static function fatal($errstr)
  {
    $error = 'Fatal Framework Error';
    include(SYS_DIR . 'handler/template/framework.php');
    die();
  }
  
  /**
   * Throws a 404 File Not Found error and stops script execution
   *
   * @return void
   * @author Ben Phelps
   */
  public static function _404()
  {
    include(SYS_DIR . 'handler/template/404.php');
    die();
  }

  /**
   * Error handler
   *
   * @param string $errno 
   * @param string $errstr 
   * @param string $errfile 
   * @param string $errline 
   * @return void
   * @author Ben Phelps
   */
  public function handler($errno, $errstr, $errfile, $errline)
  {
    
    if (FALSE !== strpos($errfile, '/'))
    {
      $x = explode('/', $errfile);
      $errfile = $x[count($x)-2].'/'.end($x);
    }
    
    $error = $this->levels[$errno];
    
    include(SYS_DIR . 'handler/template/error.php');
    
    return true;
  }

}

set_error_handler([new Error, 'handler']);

// EOF