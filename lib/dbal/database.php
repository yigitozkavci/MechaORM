<?php
namespace DBAL;

class DB {
  public static function getWithConfig($host, $dbname, $username, $password) {
    try {
      return new \PDO("mysql:host=$host;dbname=$dbname", "$username", "$password");
    } catch(\PDOException $e) {
      echo "PDOError: ".$e->getMessage();
    }
  }
}
?>
