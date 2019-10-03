<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/12/2019
 * Time: 10:25 PM
 */
require_once "controllers/Controller.php";
require_once "models/Document.php";
require_once "models/Contact.php";
require_once "models/Cart.php";
require_once "models/Banner.php";
require_once "models/Logo.php";
require_once "models/Mainpic.php";
class DocumentController extends Controller
{
    public function freeIndex(){
        $contactModel=new Contact();
        $contacts=$contactModel->getAll();

        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();

        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
        $documentModel=new Document();
        $freeDocuments=$documentModel->freeGetAll();
//        echo "<pre>";
//        print_r($freeDocuments);
//        die;
        require_once "views/documents/free/index.php";
    }

    public function feeCart(){
        $contactModel=new Contact();
        $contacts=$contactModel->getAll();

        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();

        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
        $documentModel=new Document();
        $feeDocuments=$documentModel->feeGetAll();

        if (isset($_POST['cartSubmit'])){
//            echo "<pre>";
//            print_r($_POST);
//            die;
            $id=$_POST['cartSubmit'];
            $_SESSION['cart'][$id]=$id;
//            echo "<pre>";
//            print_r($_SESSION['cart']);
//            die;
//           $cart=$_SESSION['cart'];
            if (isset($_SESSION['cart'][$id])){
                $_SESSION['success']="Thêm tài liệu vào giỏ hàng thành công";
            }
            else{
                $_SESSION['fail']="Thêm tài liệu vào giỏ hàng thất bại";
            }

//            $_SESSION['cart'];
//            echo "<pre>";
//            print_r($carts);
//            die;
//            $cartString='';
//            foreach ($_SESSION['cart'] as $session){
//                $cartString.=$session.",";
//            }
//            $cartString=rtrim($cartString,",");
////            echo "<pre>";
////            print_r($cartString);
////            die;
//            $cartModel=new Cart();
//            $selectedCarts=$cartModel->getCart($cartString);
//            $_SESSION['select']=$selectedCarts;
////            echo "<pre>";
////            print_r($_SESSION);
////            die;

//            $_SESSION['cost']=[];
//            foreach ($selectedCarts as $selectedCart){
//                $_SESSION['cost'][$selectedCart['id']]=$selectedCart['cost'];
//            }
//            echo "<pre>";
//            print_r($_SESSION);
//            die;
//            $_SESSION['cost']['total']=0;
//            foreach ($_SESSION['cost'] as $cost){
//                $_SESSION['cost']['total']+=$cost;
//            }
//            if (isset($_POST['checkCostSubmit'])){
//                echo "<pre>";
//                print_r($_POST);
//                die;
//            }
//            require_once "views/cart/index.php";
        }

        require_once "views/documents/chargeable/index.php";
    }
}