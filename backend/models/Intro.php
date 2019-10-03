<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/1/2019
 * Time: 10:55 PM
 */
 require_once "models/Model.php";
class Intro extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function getAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM intro";
        $isSelect=mysqli_query($connection,$querySelect);
        $intro=[];
        if (mysqli_num_rows($isSelect)==1){
            $intro=mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $intro;
    }
    public function update($intro){
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE intro
        SET 
            `value`='{$intro["value"]}',
            `description`='{$intro["description"]}',
            `status`='{$intro["status"]}'
        WHERE `id`=1;
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;
    }

}