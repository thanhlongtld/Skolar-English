<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/31/2019
 * Time: 10:46 PM
 */
require_once "models/Model.php";
class Info extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
        public function insert($infos = [])
        {
            $connection = $this->openConnection();
            $queryInsert = "INSERT INTO infos (`name`,`value`,`description`,`status`) 
    VALUES(
    '{$infos['name']}',
    '{$infos['value']}',
    '{$infos['description']}',
    {$infos['status']})";
            $isInsert = mysqli_query($connection, $queryInsert);
            $this->closeConnection($connection);
            return $isInsert;
        }
        public function getAll(){
            $connection = $this->openConnection();
            $querySelect = "SELECT * FROM infos";
            $isSelect = mysqli_query($connection, $querySelect);
            $infos = [];
            if (mysqli_num_rows($isSelect) > 0) {
                $infos = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
            }
            $this->closeConnection($connection);
            return $infos;
        }
    public function deleteAll()
    {
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM infos";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function deleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM infos WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function getAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM infos WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $infos = [];
        if (mysqli_num_rows($result) == 1) {
            $infos = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $info = $infos[0];
        }
        $this->closeConnection($connection);
        return $info;
    }
    public function delete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM infos WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
    public function update($infos,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE infos
        SET `name`='{$infos["name"]}',
            `value`='{$infos["value"]}',
            `description`='{$infos["description"]}',
            `status`='{$infos["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
    
}