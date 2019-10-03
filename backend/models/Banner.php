<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/19/2019
 * Time: 9:46 PM
 */
require_once "models/Model.php";

class Banner extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const BANNER_MAIN = 1;
    const BANNER_EXTRA = 0;

    public function getAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM banners";
        $isSelect = mysqli_query($connection, $querySelect);
        $banners = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $banners = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $banners;
    }

    public function insert($bannerArr)
    {
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO banners (`banner`,`type`,`description`,`status`) 
    VALUES(
    '{$bannerArr['text']}',
    '{$bannerArr['type']}',
    '{$bannerArr['description']}',
    {$bannerArr['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }

    public function deleteAll()
    {
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM banners";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function deleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM banners WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function getAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM banners WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $banners = [];
        if (mysqli_num_rows($result) == 1) {
            $banners = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $banner = $banners[0];
        }
        $this->closeConnection($connection);
        return $banner;
    }
    public function delete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM banners WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
    public function update($bannerArr,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE banners
        SET `banner`='{$bannerArr["text"]}',
            `type`='{$bannerArr["type"]}',
            `description`='{$bannerArr["description"]}',
            `status`='{$contacts["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
    public function aboutGetAll(){
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM banners_about";
        $isSelect = mysqli_query($connection, $querySelect);
        $aboutBanners = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $aboutBanners = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $aboutBanners;
    }
    public function aboutInsert($bannerArr){
        $connection = $this->openConnection();
        $queryInsert = "INSERT INTO banners_about (`banner`,`type`,`description`,`status`) 
    VALUES(
    '{$bannerArr['text']}',
    '{$bannerArr['type']}',
    '{$bannerArr['description']}',
    {$bannerArr['status']})";
        $isInsert = mysqli_query($connection, $queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
    public function aboutDeleteAll()
    {
        $connection = $this->openConnection();
        $queryDeleteAll = "DELETE FROM banners_about";
        $result = mysqli_query($connection, $queryDeleteAll);
        $this->closeConnection($connection);
        return $result;
    }
    public function aboutDeleteChecked($tickedString){
        $connection=$this->openConnection();
        $queryDelete="DELETE FROM banners_about WHERE id IN($tickedString)";
        $result=mysqli_query($connection,$queryDelete);
        $this->closeConnection($connection);
        return $result;
    }
    public function aboutGetAllByID($id)
    {
        $connection = $this->openConnection();
        $queryGetByID = "SELECT * FROM banners_about WHERE id=$id";
        $result = mysqli_query($connection, $queryGetByID);
        $banners = [];
        if (mysqli_num_rows($result) == 1) {
            $banners = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $banner = $banners[0];
        }
        $this->closeConnection($connection);
        return $banner;
    }
    public function aboutUpdate($bannerArr,$id)
    {
        $connecttion = $this->openConnection();

        $queryUpdate = "UPDATE banners_about
        SET `banner`='{$bannerArr["text"]}',
            `type`='{$bannerArr["type"]}',
            `description`='{$bannerArr["description"]}',
            `status`='{$contacts["status"]}'
        WHERE `id`=$id
        ";
        $isUpdate=mysqli_query($connecttion,$queryUpdate);
        $this->closeConnection($connecttion);
        return $isUpdate;

    }
    public function aboutDelete($id)
    {
        $connection = $this->openConnection();
        $queryDelete = "DELETE FROM banners_about WHERE id=$id";
        $results = mysqli_query($connection, $queryDelete);
        $this->closeConnection($connection);
        return $results;
    }
}