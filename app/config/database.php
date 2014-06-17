<?php

PhelpsFramework\Dependency::inject('Config')->set([
  'database' => [
    //'development' => 'mysql://root:pass@localhost/development',
    //'development' => 'sqlite://unix('.APP_DIR.'/config/development.db)',
    'development' => 'pgsql://localhost/development',
    'test' => 'mysql://root:pass@localhost/test',
    'production' => 'mysql://root:pass@localhost/production'
  ]
]);