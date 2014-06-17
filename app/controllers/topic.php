<?php

class Topic_Controller extends PhelpsFramework\Controller {


  function index()
  {
    $posts = Post::find_all_by_topic_id($this->params('id'));
    //var_dump($topics);
    return get_defined_vars();
  }

}