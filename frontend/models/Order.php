<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/29/2019
 * Time: 3:35 PM
 */
require_once "models/Model.php";

class Order extends Model
{
    public function getBiggestID(){
        $connection=$this->openConnection();
        $querySelect="SELECT MAX(id) as max from orders";
        $isSelect=mysqli_query($connection,$querySelect);
        $maxIds=[];
        if (mysqli_num_rows($isSelect)==1){
            $maxIds=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
            $maxId=$maxIds[0];
        }
        $this->closeConnection($connection);
        return $maxId;
    }
}