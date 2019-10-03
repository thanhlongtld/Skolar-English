<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/19/2019
 * Time: 8:22 PM
 */
require_once "controllers/Controller.php";
require_once "models/Mainpic.php";
class MainpicController extends Controller
{
    public function index(){
        $mainPicModel=new Mainpic();
        $mainPic=$mainPicModel->getAll();
//        echo "<pre>";
//        print_r($mainPic);
//        die;
//        echo "<pre>";
//        print_r($logo);
//        die;
        require_once "views/homes/mainpics/index.php";

    }
    public function update(){
        $mainPicModel=new Mainpic();
        $mainPicInfo=$mainPicModel->getAll();
//        echo "<pre>";
//        print_r($logoInfo);
//        die;
        if (isset($_POST['mainpic-submit'])){
            $mainPicArr=$_FILES['mainpic'];
//            echo "<pre>";
//            print_r($mainPicArr);
//            die;

            $mainPic=$mainPicInfo[0]['name'];
//            echo "<pre>";
//            print_r($logo);
//            die;

            if ($mainPicArr['error']>0){
                $_SESSION['error']="Upload ảnh chính thất bại";
                require_once "views/homes/mainpics/update.php";
                return;
            }
            if ($mainPicArr['size']>0&&$mainPicArr['error']==0){
                $extension=pathinfo($mainPicArr['name'], PATHINFO_EXTENSION);
                if (!in_array($extension,['jpg','gif','png','jpeg','JPG'])){
                    $_SESSION['error']="File tải lên phải có định dạng ảnh";
                    require_once "views/homes/mainpics/update.php";
                    return;
                }
                else if ($mainPicArr['size']>2 * 1024*1024){
                    $_SESSION['error']="File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/homes/mainpics/update.php";
                    return;
                }
            }
            if ($mainPicArr['size']>0&&$mainPicArr['error']==0){
                $dirUpload='/imguploads/mainpic';
                $absolutePathUpload=__DIR__.'/../assets'.$dirUpload;
                if (!empty($mainPic)){
                    @unlink($absolutePathUpload.'/'.$mainPic);
                }
                if (!file_exists($absolutePathUpload)){
                    mkdir($absolutePathUpload);
                }

                $mainPicName="mainpic".time().$mainPicArr['name'];
                $isMainPicUpload=move_uploaded_file($mainPicArr['tmp_name'],$absolutePathUpload.'/'.$mainPicName);
                if ($isMainPicUpload){
                    $mainPic=$mainPicName;
                }
            }
            $mainPicModel=new Mainpic();
            $isMainPicUpdate=$mainPicModel->update($mainPic);
//            echo "<pre>";
//            print_r($isLogoUpdate);
//            die;
            if ($isMainPicUpdate){
                $_SESSION['success']="Update ảnh chính thành công";
            }
            else $_SESSION['fail']="Update ảnh chính thất bại";
            header("Location:index.php?controller=mainpic&action=index");
            exit();
        }
        require_once "views/homes/mainpics/update.php";

    }
    public function aboutIndex(){
        $mainPicModel=new Mainpic();
        $mainPic=$mainPicModel->aboutGetAll();
//        echo "<pre>";
//        print_r($mainPic);
//        die;
//        echo "<pre>";
//        print_r($logo);
//        die;
        require_once "views/abouts/mainpics/index.php";

    }
    public function aboutUpdate(){
        $mainPicModel=new Mainpic();
        $mainPicInfo=$mainPicModel->aboutGetAll();
//        echo "<pre>";
//        print_r($logoInfo);
//        die;
        if (isset($_POST['mainpic-submit'])){
            $mainPicArr=$_FILES['mainpic'];
//            echo "<pre>";
//            print_r($mainPicArr);
//            die;

            $mainPic=$mainPicInfo[0]['name'];
//            echo "<pre>";
//            print_r($logo);
//            die;

            if ($mainPicArr['error']>0){
                $_SESSION['error']="Upload ảnh chính thất bại";
                require_once "views/abouts/mainpics/update.php";
                return;
            }
            if ($mainPicArr['size']>0&&$mainPicArr['error']==0){
                $extension=pathinfo($mainPicArr['name'], PATHINFO_EXTENSION);
                if (!in_array($extension,['jpg','gif','png','jpeg','JPG'])){
                    $_SESSION['error']="File tải lên phải có định dạng ảnh";
                    require_once "views/abouts/mainpics/update.php";
                    return;
                }
                else if ($mainPicArr['size']>2 * 1024*1024){
                    $_SESSION['error']="File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/abouts/mainpics/update.php";
                    return;
                }
            }
            if ($mainPicArr['size']>0&&$mainPicArr['error']==0){
                $dirUpload='/imguploads/about_mainpic';
                $absolutePathUpload=__DIR__.'/../assets'.$dirUpload;
                if (!empty($mainPic)){
                    @unlink($absolutePathUpload.'/'.$mainPic);
                }
                if (!file_exists($absolutePathUpload)){
                    mkdir($absolutePathUpload);
                }

                $mainPicName="mainpic".time().$mainPicArr['name'];
//                echo "<pre>";
//                print_r($mainPicName);
//                die;
                $isMainPicUpload=move_uploaded_file($mainPicArr['tmp_name'],$absolutePathUpload.'/'.$mainPicName);
//                                echo "<pre>";
//                print_r($isMainPicUpload);
//                die;
                if ($isMainPicUpload==1){
                    $mainPic=$mainPicName;
                }
            }
            $mainPicModel=new Mainpic();
            $isMainPicUpdate=$mainPicModel->aboutUpdate($mainPic);
//            echo "<pre>";
//            print_r($isLogoUpdate);
//            die;
            if ($isMainPicUpdate){
                $_SESSION['success']="Update ảnh chính thành công";
            }
            else $_SESSION['fail']="Update ảnh chính thất bại";
            header("Location:index.php?controller=mainpic&action=aboutIndex");
            exit();
        }
        require_once "views/abouts/mainpics/update.php";

    }
}