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
 * Custom exception handler class
 *
 * @package PhelpsFramework
 */
class ExceptionHandler
{
  /**
   * Handles the excpetion via custom view
   *
   * @param Exception $exception The exception to be handled
   * @return void
     */
  public function handler($exception) {
    $type = $exception;
    include(SYS_DIR . 'handler/template/exception.php');
  }
}

set_exception_handler([new ExceptionHandler, 'handler']);


trait toString {
  public function __toString()
  {
    return __CLASS__;
  }
}

/**
 * Basic Exception on which we expand
 *
 * @package PhelpsFramework
 */
class Exception extends \Exception { use toString; }

/**
 * Thrown when there is a problem with the configuration
 *
 * @package PhelpsFramework
 */
class ConfigurationException extends Exception { use toString; }

/**
 * Thrown when there is a problem inside a controller
 *
 * @package PhelpsFramework
 */
class ControllerException extends Exception { use toString; }

/**
 * Thrown when there is a problem routing a request
 *
 * @package PhelpsFramework
 */
class RouterException extends Exception { use toString; }

/**
 * Thrown when there is a problem with a view
 *
 * @package PhelpsFramework
 */
class ViewException extends Exception { use toString; }

/**
 * Thrown when there is a problem with a cache adapter
 *
 * @package default
 */
class CacheException extends Exception { use toString; }

/**
 * Thrown when there is a problem sanitizing a string
 *
 * @package default
 */
class ParanoidException extends Exception { use toString; }


/**
 * Thrown when there is a problem locating a file
 *
 * @package PhelpsFramework
 */
class FileNotFoundException extends Exception { use toString; }

// EOF