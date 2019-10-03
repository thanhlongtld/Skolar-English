<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/3/2019
 * Time: 10:37 AM
 */
require_once "models/Model.php";
class Video extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function getAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM video";
        $isSelect=mysqli_query($connection,$querySelect);
        $video=[];
        if (mysqli_num_rows($isSelect)==1){
            $video=mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $video;
    }
    public function update($video){
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE video
        SET 
            `value`='{$video["value"]}',
            `description`='{$video["description"]}',
            `status`='{$video["status"]}'
        WHERE `id`=1;
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;
    }
}