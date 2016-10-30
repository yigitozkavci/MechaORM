<?php
namespace App;
use \ORM\Model;

class Post extends Model{
  const TABLE_NAME = 'posts';
  const ALLOWED_ATTRIBUTES = array('id', 'text');

  protected function ALLOWED_ATTRIBUTES() {
    return ['id', 'text'];
  }
}
?>
