<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2019
 * Time: 9:24 PM
 */
require_once "models/Model.php";
class Logo extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function getAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM logo";
        $isSelect=mysqli_query($connection,$querySelect);
        $logo=[];
        if (mysqli_num_rows($isSelect)==1){
            $logo=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $logo;
    }
    public function update($logo){
        $connection=$this->openConnection();
        $queryUpdate="UPDATE logo 
        SET `logo_name`='{$logo}'
        WHERE id=1
        ";
        $isUpdate=mysqli_query($connection,$queryUpdate);
        $this->closeConnection($connection);
        return $isUpdate;
    }


}