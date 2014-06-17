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
 * FlatFile Cache Adapter
 *
 * @package PhelpsFramework
 * @author Ben Phelps
 */
class CacheFlatFile extends CacheAdapter {
  
  public function __construct()
  {
    $cache_file = APP_DIR . 'cache/cache.db';
    
    if (!file_exists($cache_file)) {
      touch($cache_file);
      $this->cache = [];
    }
    else {
      $this->cache = unserialize(gzuncompress(file_get_contents($cache_file)));
    }
    
    if (empty($this->cache)) {
      $this->cache['stats']['hit'] = 0;
      $this->cache['stats']['miss'] = 0;
      $this->cache['stats']['write'] = 0;
    }
  }

  public function read($key)
  {
    
    if (!isset($this->cache[$key])) {
      $this->commit('miss');
      return null;
    }
    elseif ( $this->cache[$key]['expire'] == 0 ) {
      $this->commit('hit');
      return unserialize($this->cache[$key]['data']);
    }
    elseif ($this->cache[$key]['expire'] <= time()) {
      $this->commit('miss');
      return null;
    }
    else {
      
    }
    
  }

  public function write($key, $value, $expire = 0)
  {
    $this->cache[$key]['expire'] = ($expire==0?0:(time()+$expire));
    $this->cache[$key]['data'] = serialize($value);
    $this->commit('write');
    return true;
  }

  public function info()
  {
    $info = [];
    $info['entries'] = count($this->cache);
    $info['hits'] = @$this->cache['stats']['hit'] || 0;
    $info['misses'] = @$this->cache['stats']['miss'] || 0;
    $info['writes'] = @$this->cache['stats']['write'] || 0;
    return $info;
  }

  public function flush()
  {
    $this->cache = [];
    $this->cache['stats']['hit'] = 0;
    $this->cache['stats']['miss'] = 0;
    $this->cache['stats']['write'] = 0;
    $this->commit();
    return true;
  }
  
  private function commit($hit = false)
  {
    if($hit) $this->cache['stats'][$hit]++;
    file_put_contents(APP_DIR . 'cache/cache.db', gzcompress(serialize($this->cache)));
  }

}