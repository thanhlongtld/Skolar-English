<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/23/2019
 * Time: 8:09 PM
 */
require_once "models/Model.php";
class Cart extends Model
{
    const ID_HN=1;
    const ID_HP=2;
    const ID_SG=3;
    const METHOD_COD=1;
    const METHOD_BANK=2;
    const CONDITION_SHIPED=1;
    const CONDITION_NSHIPED=0;
    public function getCart($cartString){
        $connection=$this->openConnection();

            $querySelect="SELECT id,name,cost FROM document_fee WHERE id IN($cartString)";
            $isSelect=mysqli_query($connection,$querySelect);
            $selectedCarts=[];
            if (mysqli_num_rows($isSelect)>0){
                $selectedCarts=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
            }

        $this->closeConnection($connection);
        return $selectedCarts;
    }
    public function createOrder($orders){
        $connection=$this->openConnection();
        $queryInsert="INSERT INTO orders (`buyer_name`,`product`,`quantity`,`total`,`condition`) VALUES (
        '{$orders['buyer_name']}',
        '{$orders['product']}',
        '{$orders['quantity']}',
        '{$orders['total']}',
        {$orders['condition']}
)";
        $isInsert=mysqli_query($connection,$queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
    public function createBuyer($buyers){
        $connection=$this->openConnection();
        $queryInsert="INSERT INTO buyer (`order_id`,`name`,`number`,`mail`,`address`,`city`,`method`,`bank_number`,`bank`,`message`) VALUES (
        {$buyers['order_id']},
        '{$buyers['name']}',
        '{$buyers['number']}',
        '{$buyers['mail']}',
        '{$buyers['address']}',
        '{$buyers['city']}',
        '{$buyers['method']}',
        '{$buyers['bankNumber']}',
        '{$buyers['bank']}',
        '{$buyers['message']}'
        
)";
        $isInsert=mysqli_query($connection,$queryInsert);
        $this->closeConnection($connection);
        return $isInsert;
    }
}