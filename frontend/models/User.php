<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/13/2019
 * Time: 10:25 AM
 */
require_once "models/Model.php";

class User extends Model
{
    public function login($user = [])
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM user 
                       WHERE `username`='{$user['name']}' AND `password`='{$user['password']}' LIMIT 1";
        $results = mysqli_query($connection, $querySelect);
        $userArr = [];
        if (mysqli_num_rows($results) == 1) {
            $userArr = mysqli_fetch_all($results, MYSQLI_ASSOC);
            $userArr = $userArr[0];
        }
        $this->closeConnection($connection);
        return $userArr;
    }

    public function create($newUser)
    {
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO user (`firstname`,`lastname`,`username`,`password`,`avatar`) VALUES (
        '{$newUser['firstname']}',
        '{$newUser['lastname']}',
        '{$newUser['username']}',
        '{$newUser['password']}',
        '{$newUser['avatar']}'
        )
        ";
        $isCreate = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isCreate;
    }

    public function detail($username)
    {
        $connnection = $this->openConnection();
        $querySelect = "SELECT * FROM user WHERE username ='$username'";
        $isSelect = mysqli_query($connnection, $querySelect);
        $userInfo = [];
        if (mysqli_num_rows($isSelect) == 1) {
            $userInfo = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
            $userInfo = $userInfo[0];
        }
        $this->closeConnection($connnection);
        return $userInfo;
    }

    public function update($newUser,$userID)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE user
        SET `firstname`='{$newUser["firstname"]}',
            `lastname`='{$newUser['lastname']}',
            `username`='{$newUser['username']}',
            `password`='{$newUser['password']}',
            `avatar`='{$newUser['avatar']}'
          
        WHERE `id`=$userID;
        ";
        $isUpdate = mysqli_query($connecttion, $queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;
    }

}