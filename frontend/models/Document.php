<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/12/2019
 * Time: 10:51 PM
 */
require_once "models/Model.php";
class Document extends Model
{
    public function freeGetAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM document_free";
        $isSelect=mysqli_query($connection,$querySelect);
        $freeDocuments=[];
        if (mysqli_num_rows($isSelect)>0){
            $freeDocuments=mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $freeDocuments;
    }
    public function feeGetAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM document_fee";
        $isSelect=mysqli_query($connection,$querySelect);
        $feeDocuments=[];
        if (mysqli_num_rows($isSelect)>0){
            $feeDocuments=mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $feeDocuments;
    }
}