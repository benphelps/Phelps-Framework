<?php

class User extends ActiveRecord\Model
{
  static $has_many = [
    ['posts'],
    ['topics']
  ];
  
  public function set_password($password) {
    $password = crypt($password);
    $this->assign_attribute('password', $password);
  }
}
