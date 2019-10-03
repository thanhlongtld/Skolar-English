<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 5:06 PM
 */
require_once "models/Model.php";

class Contact extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function insert($contacts = [])
    {
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO contact_informations (`name`,`value`,`description`,`status`) 
    VALUES(
    '{$contacts['name']}',
    '{$contacts['value']}',
    '{$contacts['description']}',
    {$contacts['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }

    public function getAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM contact_informations";
        $isSelect = mysqli_query($connection, $querySelect);
        $contacts = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $contacts = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $contacts;
    }

    public function deleteAll()
    {
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM contact_informations";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }

    public function getAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM contact_informations WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $contacts = [];
        if (mysqli_num_rows($result) == 1) {
            $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $contact = $contacts[0];
        }
        $this->closeConnection($connection);
        return $contact;
    }

    public function delete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM contact_informations WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }

    public function update($contacts,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE contact_informations
        SET `name`='{$contacts["name"]}',
            `value`='{$contacts["value"]}',
            `description`='{$contacts["description"]}',
            `status`='{$contacts["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
    public function deleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM contact_informations WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
}