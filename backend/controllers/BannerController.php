<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/19/2019
 * Time: 9:46 PM
 */
require_once "controllers/Controller.php";
require_once "models/Banner.php";

class BannerController extends Controller
{
    public function aboutDeleteAll()
    {
        $bannerModel = new Banner();
        $isDeleteAll = $bannerModel->aboutDeleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/abouts/banners/index.php";
    }
    public function aboutIndex(){
        $bannerModel = new Banner();
        $banners = $bannerModel->aboutGetAll();
        require_once "views/abouts/banners/index.php";
    }
    public function aboutCreate(){
        if (isset($_POST['banner-submit'])) {
            $bannerModel = new Banner();
            $banners = $bannerModel->aboutGetAll();
//        echo "<pre>";
//        print_r($banners);
//        die;
            $bannerTypeCheck = 1;

            foreach ($banners as $banner) {
                if ($banner['type'] == 1 && $_POST['bannerType'] == 1) {

                    $bannerTypeCheck = 0;
                    break;
                }

            }
            if ($bannerTypeCheck == 0) {
                $_SESSION['error'] = "Chỉ được có duy nhất 1 Banner chính";

                require_once "views/abouts/banners/create.php";

                return;
            }

//                    echo "<pre>";
//        print_r($_POST);
//        die;
            $bannerText = $_POST['bannerText'];
            $bannerType = $_POST['bannerType'];
            $bannerDescription = $_POST['bannerDescription'];
            $bannerStatus = $_POST['bannerStatus'];
            if (empty($bannerText)) {
                $_SESSION['error'] = "Không được để trống banner";
                require_once "views/abouts/banners/create.php";
                return;
            }
            $bannerArr = [
                'text' => $bannerText,
                'type' => $bannerType,
                'description' => $bannerDescription,
                'status' => $bannerStatus

            ];
            $bannerModel = new Banner();
            $isInsert = $bannerModel->aboutInsert($bannerArr);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm banner thành công";
            } else $_SESSION['fail'] = "Thêm banner thất bại";
            header("Location:index.php?controller=banner&action=aboutIndex");
            exit();
        }

        require_once "views/abouts/banners/create.php";
    }
    public function aboutDetail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $bannerModel = new Banner();
        $banner = $bannerModel->aboutGetAllByID($id);
        require_once "views/abouts/banners/detail.php";

    }
    public function index()
    {
        $bannerModel = new Banner();
        $banners = $bannerModel->getAll();
//        echo "<pre>";
//        print_r($banners);
//        die;
        require_once "views/homes/banners/index.php";
    }

    public function create()
    {
        if (isset($_POST['banner-submit'])) {
            $bannerModel = new Banner();
            $banners = $bannerModel->getAll();
//        echo "<pre>";
//        print_r($banners);
//        die;
            $bannerTypeCheck = 1;

            foreach ($banners as $banner) {
                if ($banner['type'] == 1 && $_POST['bannerType'] == 1) {

                    $bannerTypeCheck = 0;
                    break;
                }

            }
            if ($bannerTypeCheck == 0) {
                $_SESSION['error'] = "Chỉ được có duy nhất 1 Banner chính";

                require_once "views/homes/banners/create.php";

                return;
            }

//                    echo "<pre>";
//        print_r($_POST);
//        die;
            $bannerText = $_POST['bannerText'];
            $bannerType = $_POST['bannerType'];
            $bannerDescription = $_POST['bannerDescription'];
            $bannerStatus = $_POST['bannerStatus'];
            if (empty($bannerText)) {
                $_SESSION['error'] = "Không được để trống banner";
                require_once "views/homes/banners/create.php";
                return;
            }
            $bannerArr = [
                'text' => $bannerText,
                'type' => $bannerType,
                'description' => $bannerDescription,
                'status' => $bannerStatus

            ];
//            echo "<pre>";
//            print_r($bannerArr);
//            die;
            $bannerModel = new Banner();
            $isInsert = $bannerModel->insert($bannerArr);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm banner thành công";
            } else $_SESSION['fail'] = "Thêm banner thất bại";
            header("Location:index.php?controller=banner&action=index");
            exit();
        }

        require_once "views/homes/banners/create.php";

    }

    public function deleteAll()
    {
        $bannerModel = new Banner();
        $isDeleteAll = $bannerModel->deleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/homes/banners/index.php";
    }
    public function deleteChecked()
    {
        if (isset($_POST['checkedValueSubmit'])) {
//            echo "<pre>";
//            print_r($_POST);
//            die;
            if (isset($_POST['tickButton'])) {
                $tickedValues = $_POST['tickButton'];
//            echo "<pre>";
//            print_r($tickedValue);
//            die;
                $tickedString = '';
                foreach ($tickedValues as $tickedValue) {
                    $tickedString .= $tickedValue . ",";

                }
//            echo "<pre>";
//            print_r($tickedString);
//            die;
                $tickedString = rtrim($tickedString, ",");
//            echo "<pre>";
//            print_r($tickedString);
//            die;
                $bannerModel = new Banner();
                $isDelete = $bannerModel->deleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=banner&action=index");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=banner&action=index");
                exit();
            }

        }
        require_once "views/homes/banners/index.php";
    }
    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $bannerModel = new Banner();
        $banner = $bannerModel->getAllByID($id);
        require_once "views/homes/banners/detail.php";

    }
    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $bannerModel = new Banner();
        $isDelete = $bannerModel->delete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa biểu ngữ thành công";
        } else $_SESSION['fail'] = "Xóa biểu ngữ thất bại";
        header("Location:index.php?controller=banner&action=index");
        exit();
    }
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $bannerModel= new Banner();
        $banner=$bannerModel->getAllByID($id);
        if (isset($_POST['banner-submit'])) {
            $bannerModel = new Banner();
            $banners = $bannerModel->getAll();
            $bannerID=$bannerModel->getAllByID($id);

//        echo "<pre>";
//        print_r($bannerID);
//        die;
            $bannerTypeCheck = 1;

            foreach ($banners as $banner) {
                if ($banner['type'] == 1 && $_POST['bannerType'] == 1&&$bannerID['type']!=1) {

                    $bannerTypeCheck = 0;
                    break;
                }

            }
            if ($bannerTypeCheck == 0) {
                $_SESSION['error'] = "Chỉ được có duy nhất 1 Banner chính";

                require_once "views/homes/banners/update.php";

                return;
            }

//                    echo "<pre>";
//        print_r($_POST);
//        die;
            $bannerText = $_POST['bannerText'];
            $bannerType = $_POST['bannerType'];
            $bannerDescription = $_POST['bannerDescription'];
            $bannerStatus = $_POST['bannerStatus'];
            if (empty($bannerText)) {
                $_SESSION['error'] = "Không được để trống banner";
                require_once "views/homes/banners/update.php";
                return;
            }
            $bannerArr = [
                'text' => $bannerText,
                'type' => $bannerType,
                'description' => $bannerDescription,
                'status' => $bannerStatus

            ];
            $bannerModel = new Banner();
            $isInsert = $bannerModel->update($bannerArr,$id);
            if ($isInsert) {
                $_SESSION['success'] = "Sửa banner thành công";
            } else $_SESSION['fail'] = "Sửa banner thất bại";
            header("Location:index.php?controller=banner&action=index");
            exit();
        }

        require_once "views/homes/banners/update.php";

    }
    public function aboutDeleteChecked()
    {
        if (isset($_POST['checkedValueSubmit'])) {
//            echo "<pre>";
//            print_r($_POST);
//            die;
            if (isset($_POST['tickButton'])) {
                $tickedValues = $_POST['tickButton'];
//            echo "<pre>";
//            print_r($tickedValue);
//            die;
                $tickedString = '';
                foreach ($tickedValues as $tickedValue) {
                    $tickedString .= $tickedValue . ",";

                }
//            echo "<pre>";
//            print_r($tickedString);
//            die;
                $tickedString = rtrim($tickedString, ",");
//            echo "<pre>";
//            print_r($tickedString);
//            die;
                $bannerModel = new Banner();
                $isDelete = $bannerModel->aboutDeleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=banner&action=aboutIndex");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=banner&action=aboutIndex");
                exit();
            }

        }
        require_once "views/homes/banners/index.php";
    }
    public function aboutUpdate()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $bannerModel= new Banner();
        $banner=$bannerModel->aboutGetAllByID($id);
        if (isset($_POST['banner-submit'])) {
            $bannerModel = new Banner();
            $banners = $bannerModel->aboutGetAll();
            $bannerID=$bannerModel->aboutGetAllByID($id);

//        echo "<pre>";
//        print_r($bannerID);
//        die;
            $bannerTypeCheck = 1;

            foreach ($banners as $banner) {
                if ($banner['type'] == 1 && $_POST['bannerType'] == 1&&$bannerID['type']!=1) {

                    $bannerTypeCheck = 0;
                    break;
                }

            }
            if ($bannerTypeCheck == 0) {
                $_SESSION['error'] = "Chỉ được có duy nhất 1 Banner chính";

                require_once "views/abouts/banners/update.php";

                return;
            }

//                    echo "<pre>";
//        print_r($_POST);
//        die;
            $bannerText = $_POST['bannerText'];
            $bannerType = $_POST['bannerType'];
            $bannerDescription = $_POST['bannerDescription'];
            $bannerStatus = $_POST['bannerStatus'];
            if (empty($bannerText)) {
                $_SESSION['error'] = "Không được để trống banner";
                require_once "views/abouts/banners/update.php";
                return;
            }
            $bannerArr = [
                'text' => $bannerText,
                'type' => $bannerType,
                'description' => $bannerDescription,
                'status' => $bannerStatus

            ];
            $bannerModel = new Banner();
            $isInsert = $bannerModel->aboutUpdate($bannerArr,$id);
            if ($isInsert) {
                $_SESSION['success'] = "Sửa banner thành công";
            } else $_SESSION['fail'] = "Sửa banner thất bại";
            header("Location:index.php?controller=banner&action=aboutIndex");
            exit();
        }

        require_once "views/abouts/banners/update.php";

    }
    public function aboutDelete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $bannerModel = new Banner();
        $isDelete = $bannerModel->aboutDelete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa biểu ngữ thành công";
        } else $_SESSION['fail'] = "Xóa biểu ngữ thất bại";
        header("Location:index.php?controller=banner&action=aboutIndex");
        exit();
    }
}