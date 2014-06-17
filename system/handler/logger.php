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


class Logger
{
  public $log;
  public function log($line)
  {
    $this->log[] = $line;
  }
}


?>