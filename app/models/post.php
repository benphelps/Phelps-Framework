<?php

class Post extends ActiveRecord\Model {
  
  static $belongs_to = [
    ['topic'],
    ['user']
  ];
  
  static $delegate = [
    'name', 'username', 'to' => 'user'
  ];
  
}