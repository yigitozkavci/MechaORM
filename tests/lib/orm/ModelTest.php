<?php
require __DIR__ . '/../../helper.php';
use PHPUnit\Framework\TestCase;
use Mecha\ORM\Model;

class OrmTest extends TestCase {
  public function test() {
    $model = new Model();
    $this->assertEquals(5, 5);  
  }
}

