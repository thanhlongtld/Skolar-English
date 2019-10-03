<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/22/2019
 * Time: 10:05 AM
 */
require_once "models/Model.php";

class Course extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const COURSE_BIG=1;
    const COURSE_SMALL=2;
    const COURSE_THIN=0;

    public function insert( $courses = [])
    {
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO courses (`name`,`number_of_student`,`max_number_student`,`teacher`,`avatar`,`type`,`description`,`status`) 
    VALUES(
    '{$courses['name']}',
    {$courses['student']},
    {$courses['student_max']},
    '{$courses['teacher']}',
    '{$courses['avatar']}',
    '{$courses['type']}',
    '{$courses['description']}',
    {$courses['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
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
    public function deleteAll(){
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM courses";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function deleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM courses WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function getAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM courses WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $courses = [];
        if (mysqli_num_rows($result) == 1) {
            $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $course = $courses[0];
        }
        $this->closeConnection($connection);
        return $course;
    }
    public function update($courses,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE courses
        SET `name`='{$courses["name"]}',
            `number_of_student`='{$courses["student"]}',
            `max_number_student`='{$courses['student_max']}',
            `teacher`='{$courses['teacher']}',
            `avatar`='{$courses['avatar']}',
            `type`='{$courses['type']}',
            
            `description`='{$courses["description"]}',
            `status`='{$courses["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
    public function delete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM courses WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
}