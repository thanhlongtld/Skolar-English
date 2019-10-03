<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/2/2019
 * Time: 4:53 PM
 */
require_once "models/Video.php";
require_once "controllers/Controller.php";
class VideoController extends Controller
{
    public function index(){
        $videoModel=new Video();
        $video=$videoModel->getAll();
        require_once "views/abouts/video/index.php";
    }
    public function detail(){
        $videoModel= new Video();
        $video=$videoModel->getAll();
        require_once "views/abouts/video/detail.php";
    }
    public function update()
    {
        $videoModel= new Video();
        $video=$videoModel->getAll();
        if (isset($_POST['video-submit'])) {


            $videoValue = $_POST['videoValue'];
            $videoDescription = $_POST['videoDescription'];
            $videoStatus = $_POST['videoStatus'];

            if (empty($videoValue)) {
                $_SESSION['error'] = "Value không được để trống";
                require_once "views/abouts/video/update.php";
                return;

            }
            $video = [

                'value' => $videoValue,
                'description' => $videoDescription,
                'status' => $videoStatus,
            ];


            $videoModel = new Video();
            $isUpdate = $videoModel->update($video);
            if ($isUpdate) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=video&action=index");
            exit();

        }

        require_once "views/abouts/video/update.php";
    }
}