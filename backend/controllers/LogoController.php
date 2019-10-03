<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2019
 * Time: 8:56 PM
 */
require_once "controllers/Controller.php";
require_once "models/logo.php";
class LogoController extends Controller
{
    public function index(){
        $logoModel=new Logo();
        $logo=$logoModel->getAll();
//        echo "<pre>";
//        print_r($logo);
//        die;
        require_once "views/homes/logos/index.php";
    }
    public function update(){
        $logoModel=new Logo();
        $logoInfo=$logoModel->getAll();
//        echo "<pre>";
//        print_r($logoInfo);
//        die;
        if (isset($_POST['logo-submit'])){
            $avatarArr=$_FILES['logo'];
//            echo "<pre>";
//            print_r($avatarArr);
//            die;

            $logo=$logoInfo[0]['logo_name'];
//            echo "<pre>";
//            print_r($logo);
//            die;

            if ($avatarArr['error']>0){
                $_SESSION['error']="Upload logo thất bại";
                require_once "views/homes/logos/update.php";
                return;
            }
            if ($avatarArr['size']>0&&$avatarArr['error']==0){
                $extension=pathinfo($avatarArr['name'], PATHINFO_EXTENSION);
                if (!in_array($extension,['jpg','gif','png','jpeg','JPG'])){
                    $_SESSION['error']="File tải lên phải có định dạng ảnh";
                    require_once "views/homes/logos/update.php";
                    return;
                }
                else if ($avatarArr['size']>2 * 1024*1024){
                    $_SESSION['error']="File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/homes/logos/update.php";
                    return;
                }
            }
            if ($avatarArr['size']>0&&$avatarArr['error']==0){
                $dirUpload='/imguploads/logo';
                $absolutePathUpload=__DIR__.'/../assets'.$dirUpload;
                if (!empty($logo)){
                    @unlink($absolutePathUpload.'/'.$logo);
                }
                if (!file_exists($absolutePathUpload)){
                    mkdir($absolutePathUpload);
                }

                $logoName="logo".time().$avatarArr['name'];
                $isLogoUpload=move_uploaded_file($avatarArr['tmp_name'],$absolutePathUpload.'/'.$logoName);
                if ($isLogoUpload){
                    $logo=$logoName;
                }
            }
            $logoModel=new Logo();
            $isLogoUpdate=$logoModel->update($logo);
//            echo "<pre>";
//            print_r($isLogoUpdate);
//            die;
            if ($isLogoUpdate){
                $_SESSION['success']="Update Logo thành công";
            }
            else $_SESSION['fail']="Update Logo thất bại";
            header("Location:index.php?controller=logo&action=index");
            exit();
        }
        require_once "views/homes/logos/update.php";

    }

}