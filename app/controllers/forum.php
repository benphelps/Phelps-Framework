<?php

class Forum_Controller extends PhelpsFramework\Controller {


  public function index()
  {
    $forums = Forum::find('all', 
      ['include' => ['topics'] ]
    );
    
    return get_defined_vars();
  }

  function show()
  {
    $topics = Topic::find_all_by_id($this->params('id'), ['include' => ['posts' => ['user']]]);
    
    //var_dump($topics);
    return get_defined_vars();
  }

}