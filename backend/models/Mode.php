<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/5/2019
 * Time: 9:34 AM
 */
require_once "models/Model.php";

class Mode extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function onlineGetAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM online";
        $isSelect = mysqli_query($connection, $querySelect);
        $online = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $online = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $online;

    }
    public function onlineUpdate($online){
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE online
        SET 
            `main_banner`='{$online["main"]}',
            `extra_banner`='{$online["extra"]}',
            `video`='{$online["video"]}',
            `description`='{$online["description"]}',
            `status`='{$online["status"]}'
        WHERE `id`=1;
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;
    }
    public function offlineGetAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM offline";
        $isSelect = mysqli_query($connection, $querySelect);
        $offline = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $offline = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $offline;

    }
    public function offlineUpdate($offline){
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE offline
        SET 
            `main_banner`='{$offline["main"]}',
            `extra_banner`='{$offline["extra"]}',
            `video`='{$offline["video"]}',
            `description`='{$offline["description"]}',
            `status`='{$offline["status"]}'
        WHERE `id`=1;
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;
    }
}