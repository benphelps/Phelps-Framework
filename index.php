<?php
/**
 * @package PhelpsFramework;
 */
namespace PhelpsFramework;

$_pf_profile['start_mem'] = xdebug_memory_usage();
$_pf_profile['start_time'] = microtime(true);

define('APP_DIR', realpath('app') . '/' );
define('SYS_DIR', realpath('system') . '/' );
define('PUB_DIR', 'assets' . '/' );


require(SYS_DIR . 'handler/exception.php'); // Custom exceptions and exception handler
require(SYS_DIR . 'bootstrap/bootstrap.php'); // Bootstrap the framework

new Bootstrap([
  
  // bootstrap
  'core/paranoia', // Paranoia class, PEOPLE BE EVIL MON
  'bootstrap/singleton', // Must load first, The singleton trait, used by dependency
  'core/dependency', // Dependency Injection
  
  // error and debug
  'handler/error',
  'handler/logger',
  'development/debug',
  
  // core framework
  'core/canister',
  'core/config',
  'core/core',
  'router/route',
  'router/router',
  'model/ActiveRecord',
  'view/view',
  'controller/controller',
  
  // other
  'helper/helper',
  
  // Cache Mechanism 
  'cache/adapters/abstract',
  'cache/adapters/apc',
  'cache/adapters/memcache',
  'cache/adapters/xcache',
  'cache/adapters/file',
  'cache/cache',
  
  // autload user stuff
  'core/autoload',
]);



$_ = new Core();

if(function_exists('xdebug_enable')){
  if (Dependency::inject('Config')->get('visual_debug')) {
    include SYS_DIR . 'development/visual.php';
  }
}