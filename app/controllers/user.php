<?php

class User_Controller extends PhelpsFramework\Controller {


  function index()
  {
    $user = User::find($this->params('id'));
    $topics = $user->topics;
    $posts = $user->posts;
    return get_defined_vars();
  }

}