<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/5/2019
 * Time: 9:26 AM
 */
require_once "controllers/Controller.php";
require_once "models/Mode.php";
class ModeController extends Controller
{
    public function onlineInDex(){
        $modeModel=new Mode();
        $online=$modeModel->onlineGetAll();

        require_once "views/modes/online/index.php";
    }
    public function onlineDetail(){
        $modeModel=new Mode();
        $online=$modeModel->onlineGetAll();
//        echo "<pre>";
//        print_r($online);
//        die;

        require_once "views/modes/online/detail.php";
    }
    public function onlineUpdate(){
        $modeModel=new Mode();
        $online=$modeModel->onlineGetAll();
        if (isset($_POST['online-submit'])) {


            $onlineMain = $_POST['onlineMain'];
            $onlineExtra=$_POST['onlineExtra'];
            $onlineVideo=$_POST['onlineVideo'];
            $onlineDescription = $_POST['onlineDescription'];
            $onlineStatus = $_POST['onlineStatus'];

            if (empty($onlineMain)) {
                $_SESSION['error'] = "Banner chính không được để trống";
                require_once "views/modes/online/update.php";
                return;

            }
            if (empty($onlineExtra)) {
                $_SESSION['error'] = "Banner phụ không được để trống";
                require_once "views/modes/online/update.php";
                return;

            }

            $online = [

                'main' => $onlineMain,
                'extra' =>$onlineExtra,
                'video' =>$onlineVideo,
                'description' => $onlineDescription,
                'status' => $onlineStatus,
            ];


            $onlineModel = new Mode();
            $isUpdate = $onlineModel->onlineUpdate($online);
            if ($isUpdate) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=mode&action=onlineIndex");
            exit();

        }
        require_once "views/modes/online/update.php";
    }
    public function offlineInDex(){

        $modeModel=new Mode();
        $offline=$modeModel->offlineGetAll();

        require_once "views/modes/offline/index.php";
    }
    public function offlineDetail(){
        $modeModel=new Mode();
        $offline=$modeModel->onlineGetAll();
        require_once "views/modes/offline/detail.php";
    }
    public function offlineUpdate(){
        $modeModel=new Mode();
        $offline=$modeModel->offlineGetAll();
        if (isset($_POST['offline-submit'])) {


            $offlineMain = $_POST['offlineMain'];
            $offlineExtra=$_POST['offlineExtra'];
            $offlineVideo=$_POST['offlineVideo'];
            $offlineDescription = $_POST['offlineDescription'];
            $offlineStatus = $_POST['offlineStatus'];

            if (empty($offlineMain)) {
                $_SESSION['error'] = "Banner chính không được để trống";
                require_once "views/modes/offline/update.php";
                return;

            }
            if (empty($offlineExtra)) {
                $_SESSION['error'] = "Banner phụ không được để trống";
                require_once "views/modes/offline/update.php";
                return;

            }

            $offline = [

                'main' => $offlineMain,
                'extra' =>$offlineExtra,
                'video' =>$offlineVideo,
                'description' => $offlineDescription,
                'status' => $offlineStatus,
            ];


            $offlineModel = new Mode();
            $isUpdate = $offlineModel->offlineUpdate($offline);
            if ($isUpdate) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=mode&action=offlineIndex");
            exit();

        }
        require_once "views/modes/offline/update.php";
    }
}