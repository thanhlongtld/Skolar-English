<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/22/2019
 * Time: 3:18 PM
 */
require_once "controllers/Controller.php";
require_once "models/Document.php";
require_once "models/Contact.php";
require_once "models/Cart.php";
require_once "models/Banner.php";
require_once "models/Logo.php";
require_once "models/Mainpic.php";
require_once "models/Order.php";
class CartController extends Controller
{
    public function index()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getAll();

        $bannerModel = new Banner();
        $banners = $bannerModel->getAll();

        $logoModel = new Logo();
        $logo = $logoModel->getAll();
        $mainpicModel = new Mainpic();
        $mainpic = $mainpicModel->getAll();
        $cartString = '';
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $session) {
                $cartString .= $session . ",";
            }

        $cartString = rtrim($cartString, ",");
        $cartModel = new Cart();
        $selectedCarts = $cartModel->getCart($cartString);
        $_SESSION['select'] = $selectedCarts;

//        echo "<pre>";
//        print_r($_SESSION['select']);
//        die;
            $_SESSION['eachTotal']=[];
            foreach ($_SESSION['select'] as $session){

                $_SESSION['eachTotal'][$session['id']]=$session['cost'];
                $_SESSION['quantity'][$session['id']]=1;
                /*$_SESSION['quantity'][$session['id']]=1;*/
            }
//            echo "<pre>";
//            print_r($_SESSION['eachTotal']);
//            die;
//            $_SESSION['total']=0;
//            foreach ($_SESSION['eachTotal'] as $session){
//                $_SESSION['total']+=$session;
//            }
//            $_SESSION['quantity']=1;
//                        echo "<pre>";
//            print_r($_SESSION['total']);
//            die;
//        echo "<pre>";
//            print_r($_SESSION['quantity']);
//            die;

        }
        require_once "views/cart/index.php";
    }

    public function buy()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getAll();

        $bannerModel = new Banner();
        $banners = $bannerModel->getAll();

        $logoModel = new Logo();
        $logo = $logoModel->getAll();
        $mainpicModel = new Mainpic();
        $mainpic = $mainpicModel->getAll();
//        echo "<pre>";
//        print_r($_SESSION['select']);
//        die;
        if (isset($_POST['checkCostSubmit'])){
//            echo "<pre>";
//            print_r($_POST);
//            die;
            $_SESSION['total']=0;


            $numbers=$_POST['number'];
//            echo "<pre>";
//            print_r($numbers);
//            die;
//            echo "<pre>";
//            print_r($_SESSION['eachTotal']);
//            die;

            foreach ($_SESSION['select'] as $session){
              $_SESSION['eachTotal'][$session['id']]*=$numbers[$session['id']];


            }
//            echo "<pre>";
//            print_r($_SESSION['eachTotal']);
//            die;
            $_SESSION['quantity']=$numbers;
//            foreach ($numbers as $number){
//                $a=$number;
//                print_r($a);
//                die;
//                $_SESSION['quantity']=$number;
//            }
//            echo "<pre>";
//            print_r($_SESSION['quantity']);
//            die;

        }
        if (isset($_POST['cartSubmit'])){
            $_SESSION['number']=$_POST['number'];


//            echo "<pre>";
//            print_r($_POST);
//            die;
            header("Location:index.php?controller=cart&action=buyConfirm");
            exit();
        }
        require_once "views/cart/index.php";
    }
    public function delete(){

            if (!isset($_GET['number']) || !is_numeric($_GET['number'])) {
                $_SESSION['fail'] = 'Tham số không hợp lệ';
                header("Location: index.php?controller=cart&action=index");
                exit();
            }
            $number=$_GET['number'];
            unset($_SESSION['cart'][$_SESSION['select'][$number]['id']]);
//            $_SESSION['select']=array_values($_SESSION['select']);
//                echo "<pre>";
//            print_r($_SESSION['select']);
//            die;
//
//            unset($_SESSION['quantity'][$number]);
//            $_SESSION['quantity']=array_values($_SESSION['quantity']);
//        echo "<pre>";
//            print_r($_SESSION['quantity']);
//            die;
            header("Location:index.php?controller=cart&action=index");
            exit();

        }
//    public function buy(){
//        if (isset($_POST['cartSubmit'])){
//            require_once "views/cart/buy.php";
//        }
//    }
    public function buyConfirm(){
        $contactModel = new Contact();
        $contacts = $contactModel->getAll();

        $bannerModel = new Banner();
        $banners = $bannerModel->getAll();

        $logoModel = new Logo();
        $logo = $logoModel->getAll();
        $mainpicModel = new Mainpic();
        $mainpic = $mainpicModel->getAll();
//        echo "<pre>";
//        print_r($_SESSION);
//        die;
        if (isset($_POST['submit'])){
            $name=$_POST['buyerName'];
            $number="+84".$_POST['buyerNumber'];
            $mail=$_POST['buyerEmail'];
            $address=$_POST['buyerAddress'];
            $city=$_POST['buyerCity'];
            $method=$_POST['paymentMethod'];
            $message=$_POST['buyerMessage'];
            $bankNumber=$_POST['buyerBankNumber'];
            $bank=$_POST['buyerBank'];
            if (empty($name)){
                $_SESSION['fail']="Tên không được để trống";
                require_once "views/cart/buy.php";
            }
            if (empty($number)){
                $_SESSION['fail']="Số điện thoại không được để trống";
                require_once "views/cart/buy.php";
            }
            if (empty($mail)){
                $_SESSION['fail']="Email không được để trống";
                require_once "views/cart/buy.php";
            }
            if (empty($address)){
                $_SESSION['fail']="Địa chỉ không được để trống";
                require_once "views/cart/buy.php";
            }
            if (empty($message)){
                $message="Không có lời nhắn";
            }
            $orderModel=new Order;
            $maxID=$orderModel->getBiggestID();
//            echo "<pre>";
//            print_r($maxID);
//            die;

            $orderIds="";
            $quantity="";
            foreach ($_SESSION['select'] as $select){
                $orderIds.=$select['id'].",";
                $quantity.="#".$select['id'].":".$_SESSION['number'][$select['id']]."<br>";
            }
//            echo "<pre>";
//            print_r($quantity);
//            die;
            $orderIds=rtrim($orderIds,",");
            $total=$_SESSION['costTotal'];
//            echo "<pre>";
//            print_r($orderIds);
//            die;
            $orders=[
                'buyer_name'=>$name,
                'product'=>$orderIds,
                'quantity'=>$quantity,
                'total'=>$total,
                'condition'=> Cart::CONDITION_NSHIPED
            ];
            $cartModel=new Cart();
            $isCartInsert=$cartModel->createOrder($orders);
            $max=$maxID['max'];
            if (empty($max)){
                $max=0;
            }
            $buyers=[
                'name'=>$name,
                'order_id'=>$max,
                'number'=>$number,

                'mail'=>$mail,
                'address'=>$address,
                'city'=>$city,
                'method'=>$method,
                'message'=>$message,
                'bankNumber'=>$bankNumber,
                'bank'=>$bank
            ];

//            echo "<pre>";
//            print_r($buyers);
//            die;
//            require_once "views/cart/ordercf.php";

//            echo "<pre>";
//            print_r($number);
//            die;
            $cartModel=new Cart();
            $isBuyerInsert=$cartModel->createBuyer($buyers);
//                        echo "<pre>";
//            print_r($isBuyerInsert);
//            die;
            if ($isCartInsert&&$isBuyerInsert){
                unset($_SESSION);
                $_SESSION['success']="Đơn hàng đã được ghi nhận";
                header("Location:index.php?controller=home&action=index");
                exit();
            }
            else{
                $_SESSION['fail']="Đã xảy ra lỗi";
                header("Location:index.php?controller=home&action=index");
                exit();
            }
        }
        require_once "views/cart/buy.php";
    }

}