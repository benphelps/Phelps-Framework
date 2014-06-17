<?php

class Topic extends ActiveRecord\Model {

  static $belongs_to = ['forum'];
  
  static $has_many = [
    ['posts'],
    ['users', 'through' => 'posts']
  ];
  
  public function last_forum_topic($id)
  {
    return Topic::last(['forum_id' => $id]);
  }
  
  public function last_post_user()
  {
    return Post::find_by_topic_id($this->id)->last()->user;
  }

}