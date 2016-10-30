<?php
namespace Mecha\ORM;
require_once 'database.php';
require_once 'query.php';

class Model {
  /**
   * attrs Attributes of the model 
   * 
   * @var mixed
   * @access private
   */
  private $attrs = [];

  /**
   * Allowed attributes. Will be used for validation.
   */
  protected function ALLOWED_ATTRIBUTES() {
    return [];
  }

  /**
   * Retrieves first record of this model
   *
   * @access public
   * @return void
   */
  public static function first() {
    $query = new Query;
    $record = $query->table(static::TABLE_NAME)
                ->select('*')
                ->limit(1)
                ->execute();
    return new static($record[0]);
  }

  /**
   * @param mixed $attrs Attributes to be set for model
   * @access public
   * @return void
   */
  public function __construct($attrs = []) {
    $this->validate($attrs);
    $this->attrs = $attrs;
  }

  /**
   * update Updates the state of the model but doesn't touch to db 
   * 
   * @param mixed $attrs Attributes to be set as new state
   * @access public
   * @return void
   */
  public function update($attrs) {
    $this->validate($attrs);
    $this->attrs = array_merge($this->attrs, $attrs); 
  }

  /**
   * save Saves the current state of model to the database.
   * @access public
   * @return void
   */
  public function save() {
    try {
      $query = new Query;
      $query->table(static::TABLE_NAME)
        ->update($this->attrs)
        ->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

  /**
   * all Fetches all rows for this model's table.
   * @return void
   */
  public static function all() {
    $db = DB::get();
    try {
      $query = new Query;
      $records = $query->table(static::TABLE_NAME)
        ->select('*')
        ->execute();
      $records = array_map(function($elem) {
        return new static($elem);
      }, $records);
      return $records;
    } catch(Exception $e) {
      echo $e->getMessage();
      return [];
    }
  }

  /**
   * validate Validates attributes when they are set for this model. 
   * 
   * @param mixed $attrs 
   * @access private
   * @return void
   */
  private function validate($attrs) {
    foreach($attrs as $key => $value) {
      if(!in_array($key, static::ALLOWED_ATTRIBUTES)) {
        throw new Exception('Unallowed attribute');
      }
    }
  }
} 
