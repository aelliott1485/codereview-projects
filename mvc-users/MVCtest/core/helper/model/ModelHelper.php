<?php

// Source - https://codereview.stackexchange.com/q/164846
// Posted by DaAmidza, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-29, License - CC BY-SA 4.0

use MVCtest\core\database\DbHandler as DbHandler;
use MVCtest\core\handler\SqlError as SqlError;

class ModelHelper extends DbHandler{

    public $TestObject;
    private $status = 200;
    private static $row = NULL;



    public function __construct($test = []){
        $this->TestObject = $test;
        parent::__construct();
    }

    public function query($stmt,$row = []){
        try{
            $stmt->execute();
            $row != NULL ? self::$row = call_user_func(array($this,'fetchAll'), $stmt) : self::$row = NULL;

        }catch(\PDOException $e){
            $error = new SqlError($e->getCode());
            $this->status = $error->determiner();
        }
        return [$this->status,self::$row];
    }

    //Fetch All
    private function fetchAll($stmt){
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

}
