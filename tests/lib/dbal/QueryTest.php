<?php
require __DIR__ . '/../../helper.php';
use PHPUnit\Framework\TestCase;
use Mecha\DBAL\Query;

class QueryTest extends TestCase {
  public function testSelectAll() {
    $query = new Query;

    $expected_sql = 'SELECT * FROM posts';
    $sql = $query->table('posts')
      ->select('*')
      ->getSql();

    $this->assertEquals($sql, $expected_sql);

    $query->reset();
  }

  public function testSelectMultiple() { 
    $query = new Query;

    $expected_sql = 'SELECT name, surname, age FROM posts';
    $sql = $query->table('posts')
      ->select('name', 'surname', 'age')
      ->getSql();

    $this->assertEquals($sql, $expected_sql);
  }

  public function testSelectCount() {
    $query = new Query;

    $expected_sql = 'SELECT count(*) FROM posts';
    $sql = $query->table('posts')
      ->select('count(*)')
      ->getSql();

    $this->assertEquals($sql, $expected_sql);
  }

  public function testWhereString() {
    $query = new Query;  

    $expected_sql = "SELECT * FROM users WHERE a = 'b'";
    $sql = $query->table('users')
      ->select('*')
      ->where('a', 'b')
      ->getSql();

    $this->assertEquals($sql, $expected_sql);
  }

  public function testWhereInteger() {
    $query = new Query;

    $expected_sql = "SELECT * FROM users WHERE other = '12'";
    $sql = $query->table('users')
      ->select('*')
      ->where('other', 12)
      ->getSql();

    $this->assertEquals($sql, $expected_sql);
  }

  public function testMultipleWhere() {
    $query = new Query; 

    $expected_sql = "SELECT * FROM users WHERE first = '12' AND second = 'whoa'";
    $sql = $query->table('users')
      ->select('*')
      ->where('first', 12)
      ->where('second', 'whoa')
      ->getSql();

    $this->assertEquals($sql, $expected_sql);
  }
}
