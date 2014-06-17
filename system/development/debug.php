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

class Debug
{
  
  private $levels = [
    0 => 'log',
    1 => 'debug',
    2 => 'warn',
    3 => 'error'
  ];

  private function clean($input)
  {
    $patterns = ['/\s+/', '/(\w)\s\[(\w)/', '/\s\)\s\[(\w)/'];
    $replace = [' ', '$1, [$2', '), [$1'];
    return preg_replace($patterns, $replace, print_r($input, true));
  }

  public function console($log, $level = 0)
  {
    $level = $this->levels[$level];
    $log_clean = $this->clean($log);
    echo "<script>console.$level(\"".$log_clean."\");</script>";
  }
  
  public function log($log, $level = 1)
  {
    $level = $this->levels[$level];
    $log_clean = $this->clean($log);
    $log_line = '[' . date('YmdGis', time()) . '] ' . $log_clean . "\n";
    file_put_contents(SYS_DIR . 'logs/'.$level.'.log', $log_line, FILE_APPEND);
  }
  
  private function _mem()
  {
    $current = memory_get_usage();
    $peak = memory_get_peak_usage();
    return (object) ['current' => $current, 'peak' => $peak];
  }
  
  public function mem()
  {
    $mem = $this->_mem();
    $this->console('Peak Memory Usage: ' . $mem->peak );
    $this->console('Current Memory Usage: ' . $mem->current );
  }


}

// EOF