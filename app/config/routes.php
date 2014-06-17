<?php

PhelpsFramework\Dependency::inject('Router')->register([
  'forum/' => 'forum#index',
  'forum/:id' => 'forum#show',
  'topic/:id' => 'topic#index',
  'post/:id' => 'post#index',
  'user/:id' => 'user#index',
]);

/*

PhelpsFramework\Router::getInstance()->register([
  'landing' => 'home#landing', # http://domain.com/landing
  'promotion/:id' => 'auth#register', # http://domain.com/promotion/D5z1
  'login' => 'auth#login', # http://domain.com/login
  'register' => 'auth#register' # http://domain.com/register
]);

*/