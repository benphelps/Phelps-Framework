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
* Paranoia trait, helps sanitize things
*
* @package PhelpsFramework
* @author Ben Phelps
*/
class Paranoia {

  public function sanitize($string)
  {
    return preg_replace('/[^a-zA-Z0-9_\-\.\?\!\(\)]/', '', $string);
  }

  public function alpha()
  {
    return preg_replace('/[^a-zA-Z]/', '', $string);
  }

  public function alphanum()
  {
    return preg_replace('/[^a-zA-Z0-9]/', '', $string);
  }

  public function num()
  {
    return preg_replace('/[^0-9]/', '', $string);
  }

  public function phpize($string)
  {

    // the php variable and function name regex
    $valid_characters = '/[^a-zA-Z0-9_\x7f-\xff]*/';
    $valid_function = '/[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/';

    // replace invalid char
    $string = preg_replace($valid_characters, '', $string);

    // make sure it matches
    if(!preg_match($valid_function, $string)){
      throw new ParanoidException(
        'Failed to sanitize a function variable "'.$this->htmlize($string).'".' . '<br>' .
        'String did not match the PHP standard variable and function name regex'
      );
    }

    return $string;
  }

  public function classify($class)
  {
    return implode('_', preg_replace_callback('/(.+)/', function($string){
      return ucwords($this->phpize($string[0]));
    }, explode('_', $class)));
  }

  public function htmlize($string)
  {
    return htmlentities($string, ENT_HTML5, 'UTF-8');
  }

}

// EOF