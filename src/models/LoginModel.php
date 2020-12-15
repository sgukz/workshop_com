<?php
function Login($user, $pwd)
{
    $sql = "SELECT * 
            FROM administrator 
            WHERE `user_name` = '$user' AND `password` = '$pwd' AND is_active = 1";
    return $sql;
}
