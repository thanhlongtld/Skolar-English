<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 4:50 PM
 */
require_once "controllers/Controller.php";
class HomeController extends Controller
{
    public function index(){
        require_once "views/homes/index.php";
    }
}