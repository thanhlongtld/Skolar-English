<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 9:09 AM
 */
require_once "models/Model.php";
class Contact extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    public function getAll()
    {
        $connection = $this->openConnection();
        $querySelect = "SELECT * FROM contact_informations";
        $isSelect = mysqli_query($connection, $querySelect);
        $contacts = [];
        if (mysqli_num_rows($isSelect) > 0) {
            $contacts = mysqli_fetch_all($isSelect, MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $contacts;
    }

}