<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/27/2019
 * Time: 9:53 PM
 */
require_once "models/Model.php";
class Teacher extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function create($teachers){
        $connection=$this->openConnection();
        $queryInsert="
            INSERT INTO teachers (`name`,`date_of_birth`,`position`,`avatar`,`facebook`,`instagram`,`twitter`,`achievement`,`description`,`status`)VALUES(
            '{$teachers['name']}',
            '{$teachers['brithday']}',
            '{$teachers['position']}',
            '{$teachers['avatar']}',
            '{$teachers['facebook']}',
            '{$teachers['instagram']}',
            '{$teachers['twitter']}',
            '{$teachers['achievement']}',
            '{$teachers['description']}',
            {$teachers['status']}
            
            )
        ";
        $isInsert=mysqli_query($connection,$queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
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
    public function deleteAll(){
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM teachers";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function deleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM teachers WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function getAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM teachers WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $teachers = [];
        if (mysqli_num_rows($result) == 1) {
            $teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $teacher = $teachers[0];
        }
        $this->closeConnection($connection);
        return $teacher;
    }
    public function delete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM teachers WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
    public function update($teachers,$id){
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE teachers
        SET `name`='{$teachers["name"]}',
            `date_of_birth`='{$teachers["birthday"]}',
            `position`='{$teachers['position']}',
            `avatar`='{$teachers['avatar']}',
            `facebook`='{$teachers['facebook']}',
            
            `instagram`='{$teachers['instagram']}',
            `twitter`='{$teachers['twitter']}',
            `achievement`='{$teachers['achievement']}',
            
            `description`='{$teachers["description"]}',
            `status`='{$teachers["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
}