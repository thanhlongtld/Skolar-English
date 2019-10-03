<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/6/2019
 * Time: 10:17 AM
 */
require_once "models/Model.php";

class Document extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function freeInsert($freeDocuments=[]){
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO document_free (`name`,`banner`,`avatar`,`file`,`introduction`,`description`,`status`) 
    VALUES(
    '{$freeDocuments['name']}',
    '{$freeDocuments['banner']}',
   
    '{$freeDocuments['avatar']}',
    '{$freeDocuments['file']}',
    '{$freeDocuments['introduction']}',
    '{$freeDocuments['description']}',
    {$freeDocuments['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
    public function freeGetAll(){
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM document_free";
        $isSelect = mysqli_query($connection, $querySelect);
        $freeDocuments = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $freeDocuments = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $freeDocuments;
    }
    public function freeDeleteAll(){
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM document_free";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function freeDeleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM document_free WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function freeGetAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM document_free WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $freeDocuments = [];
        if (mysqli_num_rows($result) == 1) {
            $freeDocuments = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $freeDocument = $freeDocuments[0];
        }
        $this->closeConnection($connection);
        return $freeDocument;
    }
    public function freeDelete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM document_free WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
    public function freeUpdate($freeDocuments,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE document_free
        SET `name`='{$freeDocuments["name"]}',
            `banner`='{$freeDocuments["banner"]}',
            `avatar`='{$freeDocuments['avatar']}',
            `file`='{$freeDocuments['file']}',
            
            `introduction`='{$freeDocuments['introduction']}',
            
            
            `description`='{$freeDocuments["description"]}',
            `status`='{$freeDocuments["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
    public function feeGetAll(){
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM document_fee";
        $isSelect = mysqli_query($connection, $querySelect);
        $feeDocuments = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $feeDocuments = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $feeDocuments;
    }
    public function feeInsert($feeDocuments=[]){
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO document_fee (`name`,`avatar`,`banner`,`introduction`,`file`,`cost`,`description`,`status`) 
    VALUES(
    '{$feeDocuments['name']}',
   
    '{$feeDocuments['avatar']}',
    '{$feeDocuments['banner']}',
    '{$feeDocuments['introduction']}',
    '{$feeDocuments['file']}',
    '{$feeDocuments['cost']}',
    '{$feeDocuments['description']}',
    {$feeDocuments['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
    public function feeDeleteAll(){
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM document_fee";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function feeDeleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM document_fee WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function feeGetAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM document_fee WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $feeDocuments = [];
        if (mysqli_num_rows($result) == 1) {
            $feeDocuments = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $feeDocument = $feeDocuments[0];
        }
        $this->closeConnection($connection);
        return $feeDocument;
    }
    public function feeDelete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM document_fee WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
    public function feeUpdate($feeDocuments,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE document_fee
        SET `name`='{$feeDocuments["name"]}',
            `banner`='{$feeDocuments['banner']}',
            `avatar`='{$feeDocuments['avatar']}',
            `file`='{$feeDocuments['file']}',
            `cost`='{$feeDocuments['cost']}',
            `introduction`='{$feeDocuments['introduction']}',
            
            
            `description`='{$feeDocuments["description"]}',
            `status`='{$feeDocuments["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
}