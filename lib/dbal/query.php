<?php
namespace Mecha\DBAL;
use Database;

class Query {

  private $sql = '';
  private $multiple_where = false;
  private $table = '';
  private $query_type = 'fetch';

  public function table($table) {
    $this->table = $table;
    return $this;
  }

  public function insert($attrs = []) {
    $this->sql .= 'INSERT INTO '.$this->table
               .' ('.implode(array_keys($attrs), ', ').')'
               .' VALUES (\''.implode(array_values($attrs), '\', \'').'\')';
    return $this;
  }

  public function update($attrs = []) {
    $this->query_type = 'update';
    $this->sql = 'UPDATE '.$this->table.' SET ';
    $valueArr = '';
    foreach($attrs as $key => $val) {
      $valueArr[] = $key.' = \''.$val.'\'';
    }
    $this->sql .= implode($valueArr, ', ').';';
    return $this;
  }

  public function limit($limit = 1) {
    $this->sql .= ' LIMIT '.$limit;
    return $this;
  }

  public function select() {
    $fields = func_get_args();
    $this->sql .= 'SELECT '.implode($fields, ', ')
               .' FROM '.$this->table;
    return $this;
  }

  public function reset() {
    $this->sql = '';
    $this->multiple_where = false;
    $this->table = '';
    $this->query_type = 'fetch';
  }

  public function where($left, $right) {
    $this->sql .= ($this->multiple_where ? ' AND ' : ' WHERE ')
      .$left
      .' = \''
      .$right
      .'\'';
    $this->multiple_where = true;
    return $this;
  }

  public function getSql() {
    return $this->sql; 
  }

  public function execute() {
    $result = DB::get()->query($this->sql);
    $this->sql = '';
    return $this->query_type === 'fetch' ? $result->fetchAll(PDO::FETCH_ASSOC) : $result;
  }
}

/* $query = new Query; */
/* $query->table('posts') */
/*   ->update([ */
/*     'text' => 'wowo' */
/*   ]); */
/* var_dump($query->execute()); */

