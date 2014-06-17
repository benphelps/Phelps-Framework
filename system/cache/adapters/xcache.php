<?php
/**
 * 
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
 * XCache Cache Class
 *
 * @package PhelpsFramework
 * @author Ben Phelps
 */
class CacheXcache extends CacheAdapter {
  
  public function __construct()
  {
    try {
      var_dump(ini_get('xcache.admin.enable_auth'));
      var_dump(ini_set('xcache.admin.enable_auth', 0));
      var_dump(ini_get('xcache.admin.enable_auth'));
    } catch (Exception $e) { }
  }

  public function read($key)
  {
    return xcache_get($key);
  }

  public function write($key, $value, $expire = 0)
  {
    return xcache_set($key, $value, $expire);
  }

  public function info()
  {
    static $cacheInfos;
    if (isset($cacheInfos)) {
      return $cacheInfos;
    }
    
    $varCacheCount = xcache_count(XC_TYPE_VAR);
    $cacheInfos = array();
    global $maxHitsByHour;
    $maxHitsByHour = array(0, 0);
    $total = array();
    for ($i = 0; $i < $varCacheCount; $i ++) {
      $data = xcache_info(XC_TYPE_VAR, $i);
      $data += xcache_list(XC_TYPE_VAR, $i);
      $data['type'] = XC_TYPE_VAR;
      $data['cache_name'] = "var#$i";
      $data['cacheid'] = $i;
      $cacheInfos[] = $data;
      $maxHitsByHour[XC_TYPE_VAR] = max($maxHitsByHour[XC_TYPE_VAR], max($data['hits_by_hour']));
      if ($varCacheCount >= 2) {
        calc_total($total, $data);
      }
    }
    
    if ($varCacheCount >= 2) {
      $total['type'] = XC_TYPE_VAR;
      $total['cache_name'] = _T('Total');
      $total['cacheid'] = -1;
      $total['gc'] = null;
      $total['istotal'] = true;
      $cacheInfos[] = $total;
    }
    return $cacheInfos;
  }

  public function flush()
  {
    $varCacheCount = xcache_count(XC_TYPE_VAR);
    for ($i = 0; $i < $varCacheCount; $i ++) {
      xcache_clear_cache(XC_TYPE_VAR, $i);
    }
    return true;
  }
  
  private function calc_total(&$total, $data)
  {
    foreach ($data as $k => $v) {
      switch ($k) {
      case 'type':
      case 'cache_name':
      case 'cacheid':
      case 'free_blocks':
        continue 2;
      }
      if (!isset($total[$k])) {
        $total[$k] = $v;
      }
      else {
        switch ($k) {
        case 'hits_by_hour':
        case 'hits_by_second':
          foreach ($data[$k] as $kk => $vv) {
            $total[$k][$kk] += $vv;
          }
          break;
  
        default:
          $total[$k] += $v;
        }
      }
    }
  }

}