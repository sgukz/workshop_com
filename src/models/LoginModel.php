<?php
class Login
{
    public $username;
    public $password;
    function setUserLogin($user, $pwd)
    {
        $this->username = $user;
        $this->password = $pwd;
    }
    function getUserLogin()
    {
        $sql = "SELECT * 
            FROM administrator 
            WHERE `user_name` = '$this->username' AND `password` = '$this->password' AND is_active = 1";
        return $sql;
    }
}
