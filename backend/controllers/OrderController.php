<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 10/3/2019
 * Time: 10:48 AM
 */
require_once "models/Order.php";
require_once "controllers/Controller.php";

class OrderController
{
    public function buyerIndex(){
        $orderModel=new Order();
        $buyers=$orderModel->buyerGetAll();
        require_once "views/orders/buyers/index.php";
    }
    public function buyerDetail(){
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $orderModel=new Order();
        $buyerDetail=$orderModel->buyerDetail($id);
        $product=$buyerDetail[0]['product'];
        $productDetail=$orderModel->productDetail($product);

//        echo "<pre>";
//        print_r($productDetail);
//        die;
        require_once "views/orders/buyers/detail.php";
    }
    public function orderIndex(){
        $orderModel=new Order();
        $orders=$orderModel->orderGetAll();
//        echo "<pre>";
//        print_r($orders);
//        die;
        require_once "views/orders/order/index.php";
    }
    public function orderUpdate(){
        if (isset($_POST['update'])){
            $conditions=$_POST['condition'];
            if (empty($conditions)){
                $_SESSION['fail']="Bạn phải chọn ít nhất 1 mục";
                header("Location: index.php?controller=order&action=orderIndex");
                exit();
            }
            $conditionString="";
            foreach ($conditions as $condition){
                $conditionString.=$condition.",";
            }
            $conditionString=rtrim($conditionString,",");
            $condition_shipped=Order::CONDITION_SHIPED;
//            echo "<pre>";
//            print_r($conditionString);
//            print_r($condition_shipped);
//            die;
            $orderModel=new Order();

            $isUpdate=$orderModel->update($conditionString,$condition_shipped);
            if ($isUpdate){
                $_SESSION['success']="Cập nhật thành công";
                header("Location: index.php?controller=order&action=orderIndex");
                exit();
            }
            else {
                $_SESSION['fail']="Cập nhật thất bại";
                header("Location: index.php?controller=order&action=orderIndex");
                exit();
            }
        }
        require_once "views/orders/order/index.php";
    }
}