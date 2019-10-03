<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 9:28 AM
 */
require_once "models/Model.php";
class Teacher extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function getAll(){
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM teachers";
        $isSelect = mysqli_query($connection, $querySelect);
        $teachers = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $teachers = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $teachers;
    }
}