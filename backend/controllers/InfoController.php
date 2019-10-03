<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/31/2019
 * Time: 8:33 PM
 */
require_once "controllers/Controller.php";
require_once "models/Info.php";

class InfoController extends Controller
{
    public function index()
    {
        $infoModel = new Info();
        $infos = $infoModel->getAll();
//        echo "<pre>";
//        print_r($infos);
//        die;
        require_once "views/abouts/infos/index.php";
    }

    public function create()
    {
        if (isset($_POST['info-submit'])) {

            $infoName = $_POST['infoName'];
            $infoValue = $_POST['infoValue'];
            $infoDescription = $_POST['infoDescription'];
            $infoStatus = $_POST['infoStatus'];
            if (empty($infoName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/abouts/infos/create.php";
                return;
            }
            if (empty($infoValue)) {
                $_SESSION['error'] = "Value không được để trống";
                require_once "views/abouts/infos/create.php";
                return;

            }
            $infos = [
                'name' => $infoName,
                'value' => $infoValue,
                'description' => $infoDescription,
                'status' => $infoStatus,
            ];
//                echo "<pre>";
//                print_r($infos);
//                die;

            $infoModel = new Info();
            $isInsert = $infoModel->insert($infos);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm thông tin thành công";
            } else $_SESSION['fail'] = "Thêm thông tin thất bại";
            header("Location:index.php?controller=info&action=index");
            exit();

        }
        require_once "views/abouts/infos/create.php";

    }

    public function deleteAll()
    {
        $infoModel = new Info();
        $isDeleteAll = $infoModel->deleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/abouts/infos/index.php";
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
                $infoModel = new Info();
                $isDelete = $infoModel->deleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=info&action=index");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=info&action=index");
                exit();
            }

        }
        require_once "views/abouts/infos/index.php";
    }
    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $infoModel = new Info();
        $info = $infoModel->getAllByID($id);
        require_once "views/abouts/infos/detail.php";

    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $infoModel = new Info();
        $isDelete = $infoModel->delete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa thành công";
        } else $_SESSION['fail'] = "Xóa thất bại";
        header("Location:index.php?controller=info&action=index");
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
        $infoModel = new Info();
        $info = $infoModel->getAllByID($id);
        if (isset($_POST['info-submit'])) {

            $infoName = $_POST['infoName'];
            $infoValue = $_POST['infoValue'];
            $infoDescription = $_POST['infoDescription'];
            $infoStatus = $_POST['infoStatus'];
            if (empty($infoName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/abouts/infos/update.php";
                return;
            }
            if (empty($infoValue)) {
                $_SESSION['error'] = "Value không được để trống";
                require_once "views/abouts/infos/update.php";
                return;

            }
            $infos = [
                'name' => $infoName,
                'value' => $infoValue,
                'description' => $infoDescription,
                'status' => $infoStatus,
            ];

            $infoModel = new Info();
            $isUpdate = $infoModel->update($infos, $id);
            if ($isUpdate) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=info&action=index");
            exit();

        }

        require_once "views/abouts/infos/update.php";
    }

}