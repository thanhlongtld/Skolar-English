<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 5:06 PM
 */
require_once "controllers/Controller.php";
require_once "models/Contact.php";

class ContactController extends Controller
{
    public function index()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getAll();
//        echo "<pre>";
//        print_r($contacts);
//        die;



        require_once "views/homes/contacts/index.php";
    }

    public function create()
    {
        if (isset($_POST['contact-submit'])) {

            $contactName = $_POST['contactName'];
            $contactValue = $_POST['contactValue'];
            $contactDescription = $_POST['contactDescription'];
            $contactStatus = $_POST['contactStatus'];
            if (empty($contactName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/homes/contacts/create.php";
                return;
            }
            if (empty($contactValue)) {
                $_SESSION['error'] = "Value không được để trống";
                require_once "views/homes/contacts/create.php";
                return;

            }
            $contacts = [
                'name' => $contactName,
                'value' => $contactValue,
                'description' => $contactDescription,
                'status' => $contactStatus,
            ];

            $contactModel = new Contact();
            $isInsert = $contactModel->insert($contacts);
            if ($isInsert) {
                $_SESSION['success'] = "Thêm dữ liệu liên lạc thành công";
            } else $_SESSION['fail'] = "Thêm dữ liệu liên lạc thất bại";
            header("Location:index.php?controller=contact&action=index");
            exit();

        }
        require_once "views/homes/contacts/create.php";

    }

    public function deleteAll()
    {
        $contactModel = new Contact();
        $isDeleteAll = $contactModel->deleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/homes/contacts/index.php";
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $contactModel = new Contact();
        $contact = $contactModel->getAllByID($id);
        require_once "views/homes/contacts/detail.php";

    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $contactModel = new Contact();
        $isDelete = $contactModel->delete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa dữ liệu liên lạc thành công";
        } else $_SESSION['fail'] = "Xóa dữ liệu liên lạc thất bại";
        header("Location:index.php?controller=contact&action=index");
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
        $contactModel = new Contact();
        $contact = $contactModel->getAllByID($id);
        if (isset($_POST['contact-submit'])) {

            $contactName = $_POST['contactName'];
            $contactValue = $_POST['contactValue'];
            $contactDescription = $_POST['contactDescription'];
            $contactStatus = $_POST['contactStatus'];
            if (empty($contactName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/homes/contacts/create.php";
                return;
            }
            if (empty($contactValue)) {
                $_SESSION['error'] = "Value không được để trống";
                require_once "views/homes/contacts/create.php";
                return;

            }
            $contacts = [
                'name' => $contactName,
                'value' => $contactValue,
                'description' => $contactDescription,
                'status' => $contactStatus,
            ];

            $contactModel = new Contact();
            $isUpdate = $contactModel->update($contacts, $id);
            if ($isUpdate) {
                $_SESSION['success'] = "Update dữ liệu liên lạc thành công";
            } else $_SESSION['fail'] = "Update dữ liệu liên lạc thất bại";
            header("Location:index.php?controller=contact&action=index");
            exit();

        }

        require_once "views/homes/contacts/update.php";
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
                $contactModel = new Contact();
                $isDelete = $contactModel->deleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=contact&action=index");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=contact&action=index");
                exit();
            }

        }
        require_once "views/homes/contacts/index.php";
    }


}