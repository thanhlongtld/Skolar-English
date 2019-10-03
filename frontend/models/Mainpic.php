<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 8:57 PM
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
}