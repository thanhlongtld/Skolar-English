<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 9:21 AM
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
}