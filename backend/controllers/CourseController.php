<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/22/2019
 * Time: 10:04 AM
 */
require_once "controllers/Controller.php";
require_once "models/Course.php";

class CourseController extends Controller
{
    public function index()
    {
        $courseModel = new Course();
        $courses = $courseModel->getAll();
        require_once "views/homes/courses/index.php";
    }

    public function create()
    {
        if (isset($_POST['course-submit'])) {

            $courseName = $_POST['courseName'];
            $courseNumberStudent = $_POST['courseNumberStudent'];
            $courseNumberStudentMax = $_POST['courseNumberStudentMax'];
            $courseTeacher = $_POST['courseTeacher'];

            $courseAvatar = $_FILES['courseAvatar'];
            $courseType=$_POST['courseType'];
            $courseDescription = $_POST['courseDescription'];
            $courseStatus = $_POST['courseStatus'];


//            echo "<pre>";
//            print_r($courseAvatar);
//            die;

            if (empty($courseName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/homes/courses/create.php";
                return;
            }
            if (empty($courseNumberStudentMax)) {
                $_SESSION['error'] = "Số học viên tối đa không được để trống";
                require_once "views/homes/courses/create.php";
                return;

            }
            if (empty($courseTeacher)) {
                $_SESSION['error'] = "Tên giảng viên không được để trống";
                require_once "views/homes/courses/create.php";
                return;

            }
            if (empty($courseAvatar)) {
                $_SESSION['error'] = "Ảnh đại diện của lớp không được để trống";
                require_once "views/homes/courses/create.php";
                return;

            }
            if ($courseNumberStudent > $courseNumberStudentMax) {
                $_SESSION['error'] = "Số học sinh vượt quá giới hạn";
                require_once "views/homes/courses/create.php";
                return;

            }
            if ($courseAvatar['error'] > 0) {
                $_SESSION['error'] = "Upload ảnh lớp học thất bại";
                require_once "views/homes/courses/create.php";
                return;
            }
            if ($courseAvatar['size'] > 0 && $courseAvatar['error'] == 0) {
                $extension = pathinfo($courseAvatar['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                    $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                    require_once "views/homes/courses/create.php";
                    return;
                } else if ($courseAvatar['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/homes/courses/create.php";
                    return;
                }
            }
            $courseAva = '';
            if ($courseAvatar['size'] > 0 && $courseAvatar['error'] == 0) {
                $dirUpload = '/imguploads/courseAvatar';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
                if (!empty($courseAva)) {
                    @unlink($absolutePathUpload . '/' . $courseAva);
                }
                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload);
                }

                $courseAvaName = "courseAva" . time() . $courseAvatar['name'];
                $isCourseAvaUpload = move_uploaded_file($courseAvatar['tmp_name'], $absolutePathUpload . '/' . $courseAvaName);
                if ($isCourseAvaUpload) {
                    $courseAva = $courseAvaName;
                }
            }

            $courses = [
                'name' => $courseName,
                'student' => $courseNumberStudent,
                'student_max' => $courseNumberStudentMax,
                'teacher' => $courseTeacher,
                'avatar' => $courseAva,
                'type'=>$courseType,
                'description' => $courseDescription,
                'status' => $courseStatus,
            ];
//            echo "<pre>";
//            print_r($courses);
//            die;

            $courseModel = new Course();
            $isInsert = $courseModel->insert($courses);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isInsert) {
                $_SESSION['success'] = "Thêm dữ liệu khóa học thành công";
            } else $_SESSION['fail'] = "Thêm dữ liệu khóa học thất bại";
            header("Location:index.php?controller=course&action=index");
            exit();

        }
        require_once "views/homes/courses/create.php";

    }

    public function deleteAll()
    {
        $courseModel = new Course();
        $isDeleteAll = $courseModel->deleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/homes/courses/index.php";
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
                $courseModel = new Course();
                $isDelete = $courseModel->deleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=course&action=index");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=course&action=index");
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
        $courseModel = new Course();
        $course = $courseModel->getAllByID($id);
        require_once "views/homes/courses/detail.php";

    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $courseModel = new Course();
        $course = $courseModel->getAllByID($id);
        if (isset($_POST['course-submit'])) {

            $courseName = $_POST['courseName'];
            $courseNumberStudent = $_POST['courseNumberStudent'];
            $courseNumberStudentMax = $_POST['courseNumberStudentMax'];
            $courseTeacher = $_POST['courseTeacher'];
            $courseType=$_POST['courseType'];
            $courseDescription = $_POST['courseDescription'];
            $courseStatus = $_POST['courseStatus'];
            if ($_FILES['courseAvatar']['error']!=0){
                $courseAva=$course['avatar'];


            }
            else $courseAvatar=$_FILES['courseAvatar'];
//                            echo "<pre>";
//                print_r($courseAvatar);
//                die;


            if (empty($courseName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/homes/courses/update.php";
                return;
            }
            if (empty($courseNumberStudentMax)) {
                $_SESSION['error'] = "Số học viên tối đa không được để trống";
                require_once "views/homes/courses/update.php";
                return;

            }
            if (empty($courseTeacher)) {
                $_SESSION['error'] = "Tên giảng viên không được để trống";
                require_once "views/homes/courses/update.php";
                return;

            }
//            if (empty($courseAvatar)) {
//                $_SESSION['error'] = "Ảnh đại diện của lớp không được để trống";
//                require_once "views/homes/courses/create.php";
//                return;
//
//            }
            if ($courseNumberStudent > $courseNumberStudentMax) {
                $_SESSION['error'] = "Số học sinh vượt quá giới hạn";
                require_once "views/homes/courses/update.php";
                return;

            }

            if (isset($courseAvatar)) {
                if ($courseAvatar['error'] > 0) {
                    $_SESSION['error'] = "Upload ảnh lớp học thất bại";
                    require_once "views/homes/courses/update.php";
                    return;
                }
                if ($courseAvatar['size'] > 0 && $courseAvatar['error'] == 0) {
                    $extension = pathinfo($courseAvatar['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                        $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                        require_once "views/homes/courses/update.php";
                        return;
                    } else if ($courseAvatar['size'] > 2 * 1024 * 1024) {
                        $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                        require_once "views/homes/courses/update.php";
                        return;
                    }
                }
                $courseAva = $course['avatar'];
                if ($courseAvatar['size'] > 0 && $courseAvatar['error'] == 0) {
                    $dirUpload = '/imguploads/courseAvatar';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
                    if (!empty($courseAva)) {
                        @unlink($absolutePathUpload . '/' . $courseAva);
                    }
                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload);
                    }

                    $courseAvaName = "courseAva" . time() . $courseAvatar['name'];
                    $isCourseAvaUpload = move_uploaded_file($courseAvatar['tmp_name'], $absolutePathUpload . '/' . $courseAvaName);
                    if ($isCourseAvaUpload) {
                        $courseAva = $courseAvaName;
                    }
                }
            }

//            echo "<pre>";
//            print_r($courseAva);
//            die;

            $courses = [
                'name' => $courseName,
                'student' => $courseNumberStudent,
                'student_max' => $courseNumberStudentMax,
                'teacher' => $courseTeacher,
                'avatar' => $courseAva,
                'type' =>$courseType,
                'description' => $courseDescription,
                'status' => $courseStatus,
            ];
//            echo "<pre>";
//            print_r($courses);
//            die;

            $courseModel = new Course();
            $isUpdate = $courseModel->update($courses, $id);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isUpdate) {
                $_SESSION['success'] = "Sửa dữ liệu khóa học thành công";
            } else $_SESSION['fail'] = "Sửa dữ liệu khóa học thất bại";
            header("Location:index.php?controller=course&action=index");
            exit();

        }
        require_once "views/homes/courses/update.php";
    }
    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $courseModel = new Course();
        $isDelete = $courseModel->delete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa dữ liệu khóa học thành công";
        } else $_SESSION['fail'] = "Xóa dữ liệu khóa học thất bại";
        header("Location:index.php?controller=course&action=index");
        exit();
    }

}