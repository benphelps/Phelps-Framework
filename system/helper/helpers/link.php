<?php

/**
*
* _LICENSE_  
*
* PhelpsFramework
* PF_Helper link_to
*/

if (!function_exists('link_to')) {
  function link_to($text, $link, $tags = null)
  {
    return '<a href="'.$link.'" title="'.$text.'"'.(!empty($tags)?' '.$tags:'').'>'.$text.'</a>';
  }
}

if (!function_exists('link_to_css')) {
  function link_to_css($style, $media = null, $base = null)
  {
    $base = '//' . $_SERVER['HTTP_HOST'] . '/' . PUB_DIR;
    $style = ltrim($style, '/');
    return '<link href="'.$base.'/css/'.$style.'" rel="stylesheet" type="text/css">';
  }
}

if (!function_exists('link_to_js')) {
  function link_to_js($js, $media = null, $base = null)
  {
    $base = '//' . $_SERVER['HTTP_HOST'] . '/' . PUB_DIR;
    $js = ltrim($js, '/');
    return '<script src="'.$base.'/js/'.$js.'" type="text/javascript" charset="utf-8"></script>';
  }
}

// EOF