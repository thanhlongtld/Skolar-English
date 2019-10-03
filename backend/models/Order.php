<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 10/3/2019
 * Time: 10:49 AM
 */
require_once "models/Model.php";
class Order extends Model{
    const ID_HN=1;
    const ID_HP=2;
    const ID_SG=3;
    const METHOD_COD=1;
    const METHOD_BANK=2;
    const CONDITION_SHIPED=1;
    const CONDITION_NSHIPED=0;


    public function buyerGetAll(){
        $connection=$this->openConnection();
        $querySelect="SELECT * FROM buyer";
        $isSelect=mysqli_query($connection,$querySelect);
        $buyers=[];
        if (mysqli_num_rows($isSelect)>0){
            $buyers=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }

        $this->closeConnection($connection);
        return $buyers;
    }
    public function buyerDetail($id){
        $connection=$this->openConnection();
        $querySelect="SELECT buyer.*, orders.*,orders.id as orders_id,buyer.id as buyer from buyer
                      RIGHT JOIN orders ON buyer.order_id=orders.id
                      WHERE buyer.id=$id;
                      ";
        $isSelect=mysqli_query($connection,$querySelect);
        $buyerDetail=[];
        if (mysqli_num_rows($isSelect)>0){
            $buyerDetail=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $buyerDetail;
    }
    public function productDetail($product){
        $connection=$this->openConnection();
        $querySelect="SELECT name,avatar,file,cost FROM document_fee WHERE id IN ($product)";
        $isSelect=mysqli_query($connection,$querySelect);
        $productDetail=[];
        if (mysqli_num_rows($isSelect)>0){
            $productDetail=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }
        $this->closeConnection($connection);
        return $productDetail;
    }
    public function orderGetAll(){
        $connetion=$this->openConnection();
        $querySelect="SELECT * FROM orders";
        $isSelect=mysqli_query($connetion,$querySelect);
        $orders=[];
        if (mysqli_num_rows($isSelect)>0){
            $orders=mysqli_fetch_all($isSelect,MYSQLI_ASSOC);
        }
        $this->closeConnection($connetion);
        return $orders;
    }
    public function update($conditionString,$condition_shipped){
        $connection=$this->openConnection();
        $queryUpdate="UPDATE orders 
        SET `condition`=$condition_shipped
        WHERE id IN($conditionString)
        ";
        $isUpdate=mysqli_query($connection,$queryUpdate);
        $this->closeConnection($connection);
        return $isUpdate;
    }
}