<?php

namespace MVCtest\model\Test;

use MVCtest\core\helper\model\ModelHelper as ModelHelper;

class AddUser extends ModelHelper{

    public function main($TestObject){
        //Query
        $stmt = parent::$dbConn->prepare("INSERT INTO user(name,surname,age) VALUES(:name,:surname,:age)");
        $stmt->bindParam(':name', $TestObject->name);
        $stmt->bindParam(':surname', $TestObject->surname);
        $stmt->bindParam(':age', $TestObject->age);

        return parent::query($stmt, null);
    }

}