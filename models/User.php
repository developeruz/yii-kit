<?php
namespace app\models;

use developeruz\db_rbac\interfaces\UserRbacInterface;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser implements UserRbacInterface
{

    public function getUserName()
    {
        return $this->username;
    }
}
