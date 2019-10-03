<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/8/2019
 * Time: 9:02 AM
 */
require_once "controllers/Controller.php";
require_once "models/Contact.php";
require_once "models/Course.php";
require_once "models/Banner.php";
require_once "models/Teacher.php";
require_once "models/Logo.php";
require_once "models/Mainpic.php";
class HomeController extends Controller
{
    public function index(){

        $contactModel=new Contact();
        $contacts=$contactModel->getAll();
        $courseModel=new Course();
        $courses=$courseModel->getAll();
        $bannerModel=new Banner();
        $banners=$bannerModel->getAll();
        $teacherModel=new Teacher();
        $teachers=$teacherModel->getAll();
        $logoModel=new Logo();
        $logo=$logoModel->getAll();
        $mainpicModel=new Mainpic();
        $mainpic=$mainpicModel->getAll();
//        echo "<pre>";
//        print_r($_SESSION);
//        die;
        require_once "views/homes/index.php";

    }
}