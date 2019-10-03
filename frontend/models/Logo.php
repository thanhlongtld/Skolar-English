<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 9:21 AM
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
}