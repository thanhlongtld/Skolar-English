<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/19/2019
 * Time: 8:22 PM
 */
require_once "models/Model.php";
class Mainpic extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function getAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM main_pic";
        $isSelect=mysqli_query($connection,$querySelect);
        $mainPic='';
        if (mysqli_num_rows($isSelect)==1){
            $mainPic=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }

        $this->closeConnection($connection);
        return $mainPic;
    }
    public function update($mainPic){
        $connection=$this->openConnection();
        $queryUpdate="UPDATE main_pic 
        SET `name`='{$mainPic}'
        WHERE id=1
        ";
        $isUpdate=mysqli_query($connection,$queryUpdate);
        $this->closeConnection($connection);
        return $isUpdate;
    }
    public function aboutGetAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM main_pic_about";
        $isSelect=mysqli_query($connection,$querySelect);
        $mainPic='';
        if (mysqli_num_rows($isSelect)==1){
            $mainPic=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }

        $this->closeConnection($connection);
        return $mainPic;
    }
    public function aboutUpdate($mainPic){
        $connection=$this->openConnection();
        $queryUpdate="UPDATE main_pic_about
        SET `name`='{$mainPic}'
        WHERE id=1
        ";
        $isUpdate=mysqli_query($connection,$queryUpdate);
        $this->closeConnection($connection);
        return $isUpdate;
    }
}