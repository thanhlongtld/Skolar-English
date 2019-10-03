<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 9:10 AM
 */
require_once "models/Model.php";
class Course extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const COURSE_BIG=1;
    const COURSE_SMALL=2;
    const COURSE_THIN=0;
    public function getAll(){
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM courses";
        $isSelect = mysqli_query($connection, $querySelect);
        $courses = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $courses = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $courses;
    }
}