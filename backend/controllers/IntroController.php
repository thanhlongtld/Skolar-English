<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/1/2019
 * Time: 5:31 PM
 */
require_once "controllers/Controller.php";
require_once "models/Intro.php";
class IntroController extends Controller
{
    public function index(){
        $introModel= new Intro();
        $intro=$introModel->getAll();
//        echo "<pre>";
//        print_r($intro);
//        die;
        require_once "views/abouts/intros/index.php";

    }
    public function detail(){
        $introModel= new Intro();
        $intro=$introModel->getAll();
        require_once "views/abouts/intros/detail.php";
    }
    public function update()
    {
        $introModel= new Intro();
        $intro=$introModel->getAll();
        if (isset($_POST['intro-submit'])) {


            $introValue = $_POST['introValue'];
            $introDescription = $_POST['introDescription'];
            $introStatus = $_POST['introStatus'];

            if (empty($introValue)) {
                $_SESSION['error'] = "Value không được để trống";
                require_once "views/abouts/intros/update.php";
                return;

            }
            $intro = [

                'value' => $introValue,
                'description' => $introDescription,
                'status' => $introStatus,
            ];


            $introModel = new Intro();
            $isUpdate = $introModel->update($intro);
            if ($isUpdate) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=intro&action=index");
            exit();

        }

        require_once "views/abouts/intros/update.php";
    }

}