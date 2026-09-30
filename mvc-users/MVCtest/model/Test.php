<?php

// Source - https://codereview.stackexchange.com/q/164846
// Posted by DaAmidza, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-29, License - CC BY-SA 4.0

namespace MVCtest\model;

use MVCtest\core\database\DbHandler as DbHandler;
use MVCtest\model\Test\AddUser as AddUser;
use MVCtest\model\Test\GetUser as GetUser;
use MVCtest\model\Test\UpdateUser as UpdateUser;


class Test{

    //Add User
    public function add_user($userObject){
        $add_user = new AddUser();
        return $add_user->main($userObject);
    }

    //Get User
    public function get_users($userObjects = []){
        $get_user = new GetUser();
        return $get_user->main($userObjects);
    }

    //Update User
    public function update_user($userObjects){
        $update_user = new UpdateUser();
        return $update_user->main($userObjects);
    }

}
