<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/27/2019
 * Time: 9:53 PM
 */
require_once "controllers/Controller.php";
require_once "models/Teacher.php";

class TeacherController extends Controller
{
    public function index()
    {
        $teacherModel=new Teacher();
        $teachers=$teacherModel->getAll();
        require_once "views/homes/teachers/index.php";
    }

    public function create()
    {
        if (isset($_POST['teacher-submit'])) {
//                echo "<pre>";
//                print_r($_POST);
//                die;
            $teacherName = $_POST['teacherName'];
            $teacherBirthday = $_POST['teacherDateOfBirth'];
            $teacherPosition = $_POST['teacherPosition'];
            $teacherAvatar = $_FILES['teacherAvatar'];
            $teacherFacebook = $_POST['teacherFacebook'];
            $teacherInstagram = $_POST['teacherInstagram'];
            $teacherTwitter = $_POST['teacherTwitter'];
            $teacherAchievement = $_POST['teacherAchievement'];
            $teacherDescription = $_POST['teacherDescription'];
            $teacherStatus = $_POST['teacherStatus'];
            //                echo "<pre>";
//                print_r($_POST);
//                die;
//            echo gettype($teacherBirthday);
//            die;

            if (empty($teacherName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/homes/teachers/create.php";
                return;
            }
            if (empty($teacherPosition)) {
                $_SESSION['error'] = "Position không được để trống";
                require_once "views/homes/teachers/create.php";
                return;
            }
            if (empty($teacherBirthday)) {
                $_SESSION['error'] = "Birthday không được để trống";
                require_once "views/homes/teachers/create.php";
                return;
            }
            if (empty($teacherAvatar)) {
                $_SESSION['error'] = "Avatar không được để trống";
                require_once "views/homes/teachers/create.php";
                return;
            }
            if ($teacherAvatar['error'] > 0) {
                $_SESSION['error'] = "Upload ảnh lớp học thất bại";
                require_once "views/homes/teachers/create.php";
                return;
            }
            if ($teacherAvatar['size'] > 0 && $teacherAvatar['error'] == 0) {
                $extension = pathinfo($teacherAvatar['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                    $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                    require_once "views/homes/teachers/create.php";
                    return;
                } else if ($teacherAvatar['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/homes/teachers/create.php";
                    return;
                }
            }
            $teacherAva = '';
            if ($teacherAvatar['size'] > 0 && $teacherAvatar['error'] == 0) {
                $dirUpload = '/imguploads/teacherAvatar';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
                if (!empty($teacherAva)) {
                    @unlink($absolutePathUpload . '/' . $teacherAva);
                }
                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload,0777,true);
                }

                $teacherAvaName = "teacherAva" . time() . $teacherAvatar['name'];
                $isteacherAvaUpload = move_uploaded_file($teacherAvatar['tmp_name'], $absolutePathUpload . '/' . $teacherAvaName);
                if ($isteacherAvaUpload) {
                    $teacherAva = $teacherAvaName;
                }
            }
//                print_r($teacherAva);
//                die;
            $teachers = [
                'name' => $teacherName,
                'brithday' => $teacherBirthday,
                'position' => $teacherPosition,
                'avatar' => $teacherAva,
                'facebook' => $teacherFacebook,
                'instagram' => $teacherInstagram,
                'twitter' => $teacherTwitter,
                'achievement' => $teacherAchievement,
                'description' => $teacherDescription,
                'status' => $teacherStatus


            ];
//            echo "<pre>";
//            print_r($teachers);
//            die;
            $teacherModel = new Teacher();
            $isInsert = $teacherModel->create($teachers);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isInsert) {
                $_SESSION['success'] = "Thêm dữ liệu giảng viên thành công";
            } else $_SESSION['fail'] = "Thêm dữ liệu giảng viên thất bại";
            header("Location:index.php?controller=teacher&action=index");
            exit();

        }
        require_once "views/homes/teachers/create.php";
    }
    public function deleteAll()
    {
        $teacherModel = new Teacher();
        $isDeleteAll = $teacherModel->deleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/homes/teachers/index.php";
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
                $teacherModel = new Teacher();
                $isDelete = $teacherModel->deleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=teacher&action=index");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=teacher&action=index");
                exit();
            }

        }

    }
    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $teacherModel = new Teacher();
        $teacher = $teacherModel->getAllByID($id);
        require_once "views/homes/teachers/detail.php";

    }
    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $teacherModel = new Teacher();
        $isDelete = $teacherModel->delete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa dữ liệu thành công";
        } else $_SESSION['fail'] = "Xóa dữ liệu thất bại";
        header("Location:index.php?controller=teacher&action=index");
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
        $teacherModel = new Teacher();
        $teacher = $teacherModel->getAllByID($id);
        if (isset($_POST['teacher-submit'])) {
//                echo "<pre>";
//                print_r($_POST);
//                die;
            $teacherName = $_POST['teacherName'];
            $teacherBirthday = $_POST['teacherDateOfBirth'];
            $teacherPosition = $_POST['teacherPosition'];

            $teacherFacebook = $_POST['teacherFacebook'];
            $teacherInstagram = $_POST['teacherInstagram'];
            $teacherTwitter = $_POST['teacherTwitter'];
            $teacherAchievement = $_POST['teacherAchievement'];
            $teacherDescription = $_POST['teacherDescription'];
            $teacherStatus = $_POST['teacherStatus'];
            if ($_FILES['teacherAvatar']['error']!=0){
                $teacherAva=$teacher['avatar'];


            }
            else $teacherAvatar=$_FILES['teacherAvatar'];
//            echo gettype($teacherBirthday);
//            die;

            if (empty($teacherName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/homes/teachers/update.php";
                return;
            }
            if (empty($teacherPosition)) {
                $_SESSION['error'] = "Position không được để trống";
                require_once "views/homes/teachers/update.php";
                return;
            }
            if (empty($teacherBirthday)) {
                $_SESSION['error'] = "Birthday không được để trống";
                require_once "views/homes/teachers/update.php";
                return;
            }
            if (isset($teacherAvatar)) {
                if ($teacherAvatar['error'] > 0) {
                    $_SESSION['error'] = "Upload ảnh lớp học thất bại";
                    require_once "views/homes/teachers/update.php";
                    return;
                }
                if ($teacherAvatar['size'] > 0 && $teacherAvatar['error'] == 0) {
                    $extension = pathinfo($teacherAvatar['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                        $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                        require_once "views/homes/teachers/update.php";
                        return;
                    } else if ($teacherAvatar['size'] > 2 * 1024 * 1024) {
                        $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                        require_once "views/homes/teachers/update.php";
                        return;
                    }
                }
                $teacherAva = $teacher['avatar'];
                if ($teacherAvatar['size'] > 0 && $teacherAvatar['error'] == 0) {
                    $dirUpload = '/imguploads/$teacherAvatar';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
                    if (!empty($teacherAva)) {
                        @unlink($absolutePathUpload . '/' . $teacherAva);
                    }
                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload);
                    }

                    $teacherAvaName = "teacherAva" . time() . $teacherAvatar['name'];
                    $isTeacherAvaUpload = move_uploaded_file($teacherAvatar['tmp_name'], $absolutePathUpload . '/' . $teachereAvaName);
                    if ($isCourseAvaUpload) {
                        $teacherAva = $teacherAvaName;
                    }
                }
            }
//                print_r($teacherAva);
//                die;
            $teachers = [
                'name' => $teacherName,
                'brithday' => $teacherBirthday,
                'position' => $teacherPosition,
                'avatar' => $teacherAva,
                'facebook' => $teacherFacebook,
                'instagram' => $teacherInstagram,
                'twitter' => $teacherTwitter,
                'achievement' => $teacherAchievement,
                'description' => $teacherDescription,
                'status' => $teacherStatus


            ];
//            echo "<pre>";
//            print_r($teachers);
//            die;
            $teacherModel = new Teacher();
            $isUpdate = $teacherModel->update($teachers,$id);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isUpdate) {
                $_SESSION['success'] = "Sửa dữ liệu giảng viên thành công";
            } else $_SESSION['fail'] = "Sửa dữ liệu giảng viên thất bại";
            header("Location:index.php?controller=teacher&action=index");
            exit();

        }
        require_once "views/homes/teachers/update.php";
    }
}