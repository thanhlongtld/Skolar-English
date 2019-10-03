<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/13/2019
 * Time: 10:25 AM
 */
require_once "controllers/Controller.php";
require_once "models/User.php";
require_once "models/Contact.php";

require_once "models/Banner.php";
require_once "models/Logo.php";
require_once "models/Mainpic.php";

class UserController extends Controller
{

    public function login()
    {
        $contactModel=new Contact();
        $contacts=$contactModel->getAll();

        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();

        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (empty($username) || empty($password)) {
                $_SESSION['fail'] = "Username và password không được để trống";
                require_once "views/user/login.php";
                return;
            }
            $user = [
                'name' => $username,
                'password' => md5($password)
            ];
//            echo "<pre>";
//            print_r($user);
//            die;

            $userModel=new User();
            $userLogin=$userModel->login($user);
//            echo "<pre>";
//            print_r($userLogin);
//            die;
            if ($userLogin){
                $_SESSION['success']="Đăng nhập thành công";
                $_SESSION['username']=$userLogin['username'];
                $_SESSION['avatar']=$userLogin['avatar'];


//
//                echo "<pre>";
//                print_r($_SESSION);
//                die;
                header("Location:index.php?controller=home&action=index");
                exit();
            }
            else {
                $_SESSION['fail']="Đăng nhập thất bại";
                header("Location:index.php?controller=user&action=login");
                exit();
            }


        }
        require_once "views/user/login.php";
    }
    public function create(){
//        print_r(__DIR__);
//        die;
        $contactModel=new Contact();
        $contacts=$contactModel->getAll();

        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();

        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
        if (isset($_POST['submit'])){
            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $avatar=$_FILES['avatar'];
//                echo "<pre>";
//                print_r(__DIR__);
//                die;
//            print_r(ctype_space($username));
//            die;
            if (empty($firstname)){
                $_SESSION['fail']="Firstname không được để trống";
                require_once "views/user/create.php";
                return;
            }
            if (empty($lastname)){
                $_SESSION['fail']="Lastname không được để trống";
                require_once "views/user/create.php";
                return;
            }
            if (empty($username)){
                $_SESSION['fail']="Username không được để trống";
                require_once "views/user/create.php";
                return;
            }
            if (empty($password)){
                $_SESSION['fail']="Password không được để trống";
                require_once "views/user/create.php";
                return;
            }
            if (mb_detect_encoding($username)!='ASCII'){
                $_SESSION['fail']="Username không được có dấu";
                require_once "views/user/create.php";
                return;
            }
            if ( preg_match('/\s/',$username) ){
                $_SESSION['fail']="Username không được có dấu cách";
                require_once "views/user/create.php";
                return;
            }
            if (empty($avatar)) {
                $_SESSION['fail'] = "Avatar không được để trống";
                require_once "views/user/create.php";
                return;
            }
            if ($avatar['error'] > 0) {
                $_SESSION['error'] = "Upload ảnh thất bại";
                require_once "views/user/create.php";
                return;
            }
            if ($avatar['size'] > 0 && $avatar['error'] == 0) {
                $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                    $_SESSION['fail'] = "File tải lên phải có định dạng ảnh";
                    require_once "views/user/create.php";
                    return;
                } else if ($avatar['size'] > 2 * 1024 * 1024) {
                    $_SESSION['fail'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/user/create.php";
                    return;
                }
            }
            $Ava = '';
            if ($avatar['size'] > 0 && $avatar['error'] == 0) {
                $dirUpload = '/imguploads/avatar';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
//                if (!empty($Ava)) {
//                    @unlink($absolutePathUpload . '/' . $Ava);
//                }
//                echo "<pre>";
//                print_r($absolutePathUpload);
//                die;
                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload,0777,true);
                }

                $AvaName = "Ava" . time() . $avatar['name'];
                $isAvaUpload = move_uploaded_file($avatar['tmp_name'], $absolutePathUpload . '/' . $AvaName);
                if ($isAvaUpload) {
                    $Ava = $AvaName;
                }
            }
//            echo "<pre>";
//            print_r($Ava);
//            die;
            $newUser=[
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'username'=>$username,
                'password'=>md5($password),
                'avatar'=>$Ava
            ];
//            echo "<pre>";
//            print_r($newUser);
//            die;
            $userModel=new User();
            $isCreate=$userModel->create($newUser);
            if ($isCreate){
                $_SESSION['success']="Đăng kí thành công";
                header("Location:index.php?controller=home&action=index");
                exit();

            }
            else {
                $_SESSION['fail'] = "Đăng kí thất bại";
                header("Location:index.php?controller=user&action=login");
                exit();
            }

        }
        require_once "views/user/create.php";
    }
    public function detail(){
        $contactModel=new Contact();
        $contacts=$contactModel->getAll();

        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();

        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
        if (!isset($_GET['username'])){
            $_SESSION['fail']="Không tìm thấy thông tin tài khoản";
            header("Location:index.php?controller=home&action=index");
            exit();
        }
        $username=$_GET['username'];
        $userModel=new User();
        $userInfo=$userModel->detail($username);
//        echo "<pre>";
//        print_r($userInfo);
//        die;



//        $loginModel=new User();
//        $user=$logoModel->
//        $user=$this->login();
//        echo "<pre>";
//        print_r($user);
//        die;
        require_once "views/user/detail.php";
    }
    public function update(){
        $contactModel=new Contact();
        $contacts=$contactModel->getAll();

        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();

        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
        if (!isset($_GET['username'])){
            $_SESSION['fail']="Không tìm thấy thông tin tài khoản";
            header("Location:index.php?controller=home&action=index");
            exit();
        }
        $username=$_GET['username'];
        $userModel=new User();
        $userInfo=$userModel->detail($username);
        $userID=$userInfo['id'];
//        echo "<pre>";
//        print_r($userInfo);
//        die;
        if (isset($_POST['submit'])){
            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            if ($_FILES['avatar']['error']!=0){
                $Ava=$userInfo['avatar'];


            }
            else $avatar=$_FILES['avatar'];
//                echo "<pre>";
//                print_r(__DIR__);
//                die;
//            print_r(ctype_space($username));
//            die;
            if (empty($firstname)){
                $_SESSION['fail']="Firstname không được để trống";
                require_once "views/user/update.php";
                return;
            }
            if (empty($lastname)){
                $_SESSION['fail']="Lastname không được để trống";
                require_once "views/user/update.php";
                return;
            }
            if (empty($username)){
                $_SESSION['fail']="Username không được để trống";
                require_once "views/user/update.php";
                return;
            }
            if (empty($password)){
                $_SESSION['fail']="Password không được để trống";
                require_once "views/user/update.php";
                return;
            }
            if (mb_detect_encoding($username)!='ASCII'){
                $_SESSION['fail']="Username không được có dấu";
                require_once "views/user/update.php";
                return;
            }
            if ( preg_match('/\s/',$username) ){
                $_SESSION['fail']="Username không được có dấu cách";
                require_once "views/user/update.php";
                return;
            }
            if (isset($avatar)) {
                if (empty($avatar)) {
                    $_SESSION['fail'] = "Avatar không được để trống";
                    require_once "views/user/update.php";
                    return;
                }
                if ($avatar['error'] > 0) {
                    $_SESSION['error'] = "Upload ảnh thất bại";
                    require_once "views/user/update.php";
                    return;
                }
                if ($avatar['size'] > 0 && $avatar['error'] == 0) {
                    $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                        $_SESSION['fail'] = "File tải lên phải có định dạng ảnh";
                        require_once "views/user/update.php";
                        return;
                    } else if ($avatar['size'] > 2 * 1024 * 1024) {
                        $_SESSION['fail'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                        require_once "views/user/update.php";
                        return;
                    }
                }
                $Ava = $userInfo['avatar'];
                if ($avatar['size'] > 0 && $avatar['error'] == 0) {
                    $dirUpload = '/imguploads/avatar';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
                if (!empty($Ava)) {
                    @unlink($absolutePathUpload . '/' . $Ava);
                }
//                echo "<pre>";
//                print_r($absolutePathUpload);
//                die;
                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload, 0777, true);
                    }

                    $AvaName = "Ava" . time() . $avatar['name'];
                    $isAvaUpload = move_uploaded_file($avatar['tmp_name'], $absolutePathUpload . '/' . $AvaName);
                    if ($isAvaUpload) {
                        $Ava = $AvaName;
                    }
                }
//            echo "<pre>";
//            print_r($Ava);
//            die;
            }
            $newUser=[
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'username'=>$username,
                'password'=>md5($password),
                'avatar'=>$Ava
            ];
//            echo "<pre>";
//            print_r($newUser);
//            die;
            $userModel=new User();
            $isUpdate=$userModel->update($newUser,$userID);
//            echo "<pre>";
//            print_r($isUpdate);
//            die;
            if ($isUpdate){
                $_SESSION['success']="Cập nhật thành công";
                $_SESSION['username']=$newUser['username'];
                header("Location:index.php?controller=home&action=index");
                exit();

            }
            else {
                $_SESSION['fail'] = "Cập nhật thất bại";
                header("Location:index.php?controller=user&action=login");
                exit();
            }

        }
//        echo "<pre>";
//        print_r($userInfo);
//        die;
        require_once "views/user/update.php";
    }
    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['avatar']);
        header("Location:index.php?controller=home&action=index");
        exit();
    }

}