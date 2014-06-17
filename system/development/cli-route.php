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

class CLIRoute
{
  var $mime = [
    'css' => 'text/css',
    'js' => 'text/javascript',
  ];
  public function __construct()
  {
    $this->file['file'] = PUB_DIR . trim($_SERVER["REQUEST_URI"], '/');
    if (is_file($this->file['file'])) {
      $ext = explode('.', $this->file['file']); $ext = $ext[count($ext)-1];
      if (isset($this->mime[$ext])) {
        $this->file['mime'] = $this->mime[$ext];
      }
      else {
        $this->file['mime'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->file['file']);
      }
    }
    else {
      $this->file['mime'] = false;
    }
  }
  private function match_uri()
  {
    return preg_match('/\.(?:png|jpg|jpeg|gif|ico|css|html|js)$/', $_SERVER["REQUEST_URI"]);
  }
  private function file_exists()
  {
    if (file_exists($this->file['file'])) return true;
    return false;
  }
  private function read()
  {
    $mime = $this->file['mime'];
    header("Content-Type: ${mime}");
    readfile($this->file['file']);
  }
  public function do_dispatch()
  {
    return $this->match_uri();
  }
  public function dispatch()
  {
    if ($this->file_exists()) {
      $this->read();
      return true;
    }
    else {
      include(SYS_DIR . 'handler/template/404.php');
      return true;
    }
  }
}

// EOF