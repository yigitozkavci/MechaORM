<?php
namespace DBAL;

class DB {
  public static function get() {
    try {
      return new PDO("mysql:host=localhost;dbname=php_blog", 'root', 'root');
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}
?>

