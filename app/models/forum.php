<?php

class Forum extends ActiveRecord\Model {

  static $has_many = [
  
    ['topics'],
    ['posts'],
    ['users', 'through' => 'posts']
  
  ];
  
  public function topics()
  {
    return Topic::find_all_by_forum_id($this->id, ['include' => ['posts' => ['user']]]);
  }
  
  public function posts()
  {
    return Posts::find_all_by_forum_id($this->id, ['include' => ['user']]);
  }
  
  public function topic_count()
  {
    return Topic::count(['forum_id' => $this->id]);
  }
  
  public function post_count()
  {
    return Post::count(['forum_id' => $this->id]);
  }
  
  public function latest_post()
  {
    return Post::last(['forum_id' => $this->id], ['include' => ['user']]);
  }

}