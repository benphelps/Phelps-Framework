<?php
$_pf_profile['end_time'] = microtime(true);
$_pf_profile['MemoryUsage'] = number_format( round((xdebug_memory_usage()-$_pf_profile['start_mem']) / 1024, 2), 2) . 'kb';
$_pf_profile['PeakMemory'] = number_format( round(xdebug_memory_usage() / 1024, 2), 2) . 'kb';
$_pf_profile['TimeToReq'] = (float)round( (($_pf_profile['end_time'] - $_pf_profile['start_time'])-($_pf_profile['start_time']-$_SERVER['REQUEST_TIME_FLOAT']))*1000000, 0);
$_pf_profile['ExecTime'] = (float)round(($_pf_profile['end_time'] - $_pf_profile['start_time'])*1000000, 0);
$_pf_profile['rusage'] = getrusage();
$_pf_profile['ru_maxrss'] = number_format( round($_pf_profile['rusage']['ru_maxrss'] / 1024 / 1024, 2), 2) . 'mb';
$_pf_profile['pid'] = getmypid();
$_pf_profile['inode'] = getmyinode();
?>
<style type="text/css" media="screen">
  * {
    outline: none;
  }
  #pf_performance {
    font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
    font-weight: 200;
    position: fixed;
    bottom: 0px;
    right: 0px;
    min-width: 420px;
    min-height: 55px;
    max-height: 600px;
    overflow-y: auto;
    border-radius: 10px 0px 0px 0px;
    background-color: #000;
    color: #f7f7f7;
  }
  .pf_usage {
    display: inline-block;
    padding-left: 10px;
    padding-top: 2px;
    width: 190px;
    font-size: 12px;
    clear: both;
  }
  .pf_usage h2 {
    font-variant: small-caps;
    margin: 0;
    padding: 0;
    font-size: 16px;
    text-shadow: 1px 1px 0px #000;
  }
  .pf_usage h2 a {
    color: #fff;
  }
  .pf_debug {
    padding-left: 10px;
    padding-top: 2px;
  }
  #pf_fixed {
    position: fixed;
    background: rgba(0, 0, 0, 0.800);
    border-radius: 10px 0px 0px 0px;
    padding-bottom: 4px;
  }
  #pf_stats {
    position: absolute;
    top: 0;
  }
  #pf_debug {
    margin-top: 45px;
  }
  #pf_sql {
    margin-top: 45px;
  }
</style>
<div id="pf_performance">
  <div id="pf_stats">
    <div id="pf_fixed">
      <div class="pf_usage">
        <h2>PhelpsFramework Debug</h2>
        Process Time: <?=number_format($_pf_profile['ExecTime']/1000)?>ms <br>
        Time To Request: <?=number_format($_pf_profile['TimeToReq']/1000)?>ms <br>
      </div>
      <div class="pf_usage">
        <h2><a id="pf_show_stack" href="#">Show Obj</a> <a id="pf_show_sql" href="#">Show SQL</a></h2>
        Memory Usage: <?=$_pf_profile['MemoryUsage']?> <br>
        Peak Memory Usage: <?=$_pf_profile['PeakMemory']?>
      </div>
    </div>
  </div>
  <div id="pf_debug" class="pf_debug" style="display: none;">
    <?=var_dump($_)?>
  </div>
  <div id="pf_sql" class="pf_debug" style="display: none;">
    <?=var_dump(\ActiveRecord\Config::instance()->get_logger()->log)?>
  </div>
</div>
<script type="text/javascript" charset="utf-8">$('#pf_show_stack').click(function(){$('#pf_debug').slideToggle();});$('#pf_show_sql').click(function(){$('#pf_sql').slideToggle();});</script>