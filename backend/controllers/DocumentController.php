<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/6/2019
 * Time: 10:16 AM
 */
require_once "controllers/Controller.php";
require_once "models/Document.php";
class DocumentController extends Controller
{
    public function freeIndex(){
        $freeDocumentModel=new Document();
        $freeDocuments=$freeDocumentModel->freeGetAll();
        require_once "views/documents/free/index.php";
    }
    public function freeCreate()
    {
        if (isset($_POST['free-submit'])){
            $freeDocumentName = $_POST['freeDocumentName'];
            $freeDocumentAvatar = $_FILES['freeDocumentAvatar'];
            $freeDocumentFile=$_FILES['freeDocumentFile'];
            $freeDocumentIntroduction = $_POST['freeDocumentIntroduction'];
            $freeDocumentDescription = $_POST['freeDocumentDescription'];
            $freeDocumentStatus = $_POST['freeDocumentStatus'];
            $freeDocumentBanner=$_POST['freeDocumentBanner'];

//            echo "<pre>";
//            print_r($freeDocumentIntroduction);
//            die;

            if (empty($freeDocumentName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/documents/free/create.php";
                return;
            }
            if (empty($freeDocumentBanner)) {
                $_SESSION['error'] = "Banner không được để trống";
                require_once "views/documents/free/create.php";
                return;
            }

            if (empty($freeDocumentAvatar)) {
                $_SESSION['error'] = "Ảnh đại diện tài liệu không được để trống";
                require_once "views/documents/free/create.php";
                return;

            }
            if (empty($freeDocumentFile)) {
                $_SESSION['error'] = "File tài liệu không được để trống";
                require_once "views/documents/free/create.php";
                return;

            }
            if (empty($freeDocumentIntroduction)) {
                $_SESSION['error'] = "Phần giới thiệu không được để trống";
                require_once "views/documents/free/create.php";
                return;

            }

            if ($freeDocumentAvatar['error'] > 0) {
                $_SESSION['error'] = "Upload ảnh thất bại";
                require_once "views/documents/free/create.php";
                return;
            }
            if ($freeDocumentAvatar['size'] > 0 && $freeDocumentAvatar['error'] == 0) {
                $extension = pathinfo($freeDocumentAvatar['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                    $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                    require_once "views/documents/free/create.php";
                    return;
                } else if ($freeDocumentAvatar['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/documents/free/create.php";
                    return;
                }
            }
            $freeDocumentAva = '';
            if ($freeDocumentAvatar['size'] > 0 && $freeDocumentAvatar['error'] == 0) {
                $dirUpload = '/imguploads/freeDocumentAvatar';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;

                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload);
                }

                $freeDocumentAvaName = "freeDocumentAva" . time() . $freeDocumentAvatar['name'];
                $isfreeDocumentAvaUpload = move_uploaded_file($freeDocumentAvatar['tmp_name'], $absolutePathUpload . '/' . $freeDocumentAvaName);
                if ($isfreeDocumentAvaUpload) {
                    $freeDocumentAva = $freeDocumentAvaName;
                }
            }
            if ($freeDocumentFile['error'] > 0) {
                $_SESSION['error'] = "Upload file thất bại";
                require_once "views/documents/free/create.php";
                return;
            }
            if ($freeDocumentFile['size'] > 0 && $freeDocumentFile['error'] == 0) {
                $extension = pathinfo($freeDocumentFile['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['pdf'])) {
                    $_SESSION['error'] = "File tải lên phải có định dạng PDF";
                    require_once "views/documents/free/update.php";
                    return;
                }
            }
            $freeDocumentFi='';
            if ($freeDocumentFile['size'] > 0 && $freeDocumentFile['error'] == 0) {
                $dirUpload = '/files/freeDocumentFile';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;

                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload,0777,true);
                }

                $freeDocumentFileName = "freeDocumentFile" . time() . $freeDocumentFile['name'];
                $isfreeDocumentFileUpload = move_uploaded_file($freeDocumentFile['tmp_name'], $absolutePathUpload . '/' . $freeDocumentFileName);
                if ($isfreeDocumentAvaUpload) {
                    $freeDocumentFi = $freeDocumentFileName;
                }
            }
            $freeDocuments = [
                'name' => $freeDocumentName,
                'banner' => $freeDocumentBanner,
                'file'=>$freeDocumentFi,
                'avatar' => $freeDocumentAva,
                'introduction'=>$freeDocumentIntroduction,
                'description' => $freeDocumentDescription,
                'status' => $freeDocumentStatus,
            ];
//            echo "<pre>";
//            print_r($freeDocuments);
//            die;

            $freeDocumentModel = new Document();
            $isInsert = $freeDocumentModel->freeInsert($freeDocuments);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isInsert) {
                $_SESSION['success'] = "Thêm thành công";
            } else $_SESSION['fail'] = "Thêm thất bại";
            header("Location:index.php?controller=document&action=freeIndex");
            exit();
        }
        require_once "views/documents/free/create.php";

    }
    public function freeDeleteAll()
    {
        $freeDocumentModel = new Document();
        $isDeleteAll = $freeDocumentModel->freeDeleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/documents/free/index.php";
    }
    public function freeDeleteChecked()
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
                $freeDocumentModel = new Document();
                $isDelete = $freeDocumentModel->freeDeleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=document&action=freeIndex");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=document&action=freeIndex");
                exit();
            }

        }

    }
    public function freeDetail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $freeDocumentModel = new Document();
        $freeDocument = $freeDocumentModel->freeGetAllByID($id);
        require_once "views/documents/free/detail.php";

    }
    public function freeDelete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $freeDocumentDelete = new Document();
        $isDelete = $freeDocumentDelete->freeDelete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa dữ liệu thành công";
        } else $_SESSION['fail'] = "Xóa dữ liệu thất bại";
        header("Location:index.php?controller=document&action=freeIndex");
        exit();
    }
    public function freeUpdate()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $freeDocumentModel= new Document();
        $freeDocument=$freeDocumentModel->freeGetAllByID($id);

        if (isset($_POST['free-submit'])){
            $freeDocumentName = $_POST['freeDocumentName'];
            $freeDocumentBanner=$_POST['freeDocumentBanner'];
            $freeDocumentIntroduction = $_POST['freeDocumentIntroduction'];
            $freeDocumentDescription = $_POST['freeDocumentDescription'];
            $freeDocumentStatus = $_POST['freeDocumentStatus'];
            if ($_FILES['freeDocumentAvatar']['error']!=0){
                $freeDocumentAva=$freeDocument['avatar'];


            }
            else $freeDocumentAvatar=$_FILES['freeDocumentAvatar'];
            if ($_FILES['freeDocumentAvatar']['error']!=0){
                $freeDocumentFi=$freeDocument['file'];


            }
            else $freeDocumentFile=$_FILES['freeDocumentFile'];
//            echo "<pre>";
//            print_r($freeDocumentIntroduction);
//            die;

            if (empty($freeDocumentName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/documents/free/update.php";
                return;
            }
            if (empty($freeDocumentBanner)) {
                $_SESSION['error'] = "Banner không được để trống";
                require_once "views/documents/free/update.php";
                return;
            }


            if (empty($freeDocumentIntroduction)) {
                $_SESSION['error'] = "Phần giới thiệu không được để trống";
                require_once "views/documents/free/update.php";
                return;

            }
            if (isset($freeDocumentAvatar)) {
                if ($freeDocumentAvatar['error'] > 0) {
                    $_SESSION['error'] = "Upload ảnh thất bại";
                    require_once "views/documents/free/update.php";
                    return;
                }
                if ($freeDocumentAvatar['size'] > 0 && $freeDocumentAvatar['error'] == 0) {
                    $extension = pathinfo($freeDocumentAvatar['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                        $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                        require_once "views/documents/free/update.php";
                        return;
                    } else if ($freeDocumentAvatar['size'] > 2 * 1024 * 1024) {
                        $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                        require_once "views/documents/free/update.php";
                        return;
                    }
                }
                $freeDocumentAva = $freeDocument['avatar'];
                if ($freeDocumentAvatar['size'] > 0 && $freeDocumentAvatar['error'] == 0) {
                    $dirUpload = '/imguploads/freeDocumentAvatar';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
//                    echo "<pre>";
//                    print_r($freeDocumentAva);
//                    die;
                    if (!empty($freeDocumentAva)) {
                        @unlink($absolutePathUpload . '/' . $freeDocumentAva);
                    }

                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload);
                    }

                    $freeDocumentAvaName = "freeDocumentAva" . time() . $freeDocumentAvatar['name'];
                    $isfreeDocumentAvaUpload = move_uploaded_file($freeDocumentAvatar['tmp_name'], $absolutePathUpload . '/' . $freeDocumentAvaName);
                    if ($isfreeDocumentAvaUpload) {
                        $freeDocumentAva = $freeDocumentAvaName;
                    }
                }

            }
            if (isset($freeDocumentFile)) {
                if ($freeDocumentFile['error'] > 0) {
                    $_SESSION['error'] = "Upload file thất bại";
                    require_once "views/documents/free/update.php";
                    return;
                }
                if ($freeDocumentFile['size'] > 0 && $freeDocumentFile['error'] == 0) {
                    $extension = pathinfo($freeDocumentFile['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['pdf'])) {
                        $_SESSION['error'] = "File tải lên phải có định dạng PDF";
                        require_once "views/documents/free/update.php";
                        return;
                    }
                }
                $freeDocumentFi = $freeDocument['avatar'];
                if ($freeDocumentFile['size'] > 0 && $freeDocumentFile['error'] == 0) {
                    $dirUpload = '/files/freeDocumentFile';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
//                    echo "<pre>";
//                    print_r($freeDocumentAva);
//                    die;


                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload);
                    }

                    $freeDocumentFileName = "freeDocumentFile" . time() . $freeDocumentFile['name'];
                    $isfreeDocumentFileUpload = move_uploaded_file($freeDocumentFile['tmp_name'], $absolutePathUpload . '/' . $freeDocumentFileName);
                    if ($isfreeDocumentFileUpload) {
                        if (!empty($freeDocumentFi)) {
                            @unlink($absolutePathUpload . '/' . $freeDocumentFi);
                        }
                        $freeDocumentFi = $freeDocumentAvaName;
                    }
                }

            }

            $freeDocuments = [
                'name' => $freeDocumentName,
                'banner' =>$freeDocumentBanner,

                'avatar' => $freeDocumentAva,
                'file'=>$freeDocumentFi,
                'introduction'=>$freeDocumentIntroduction,
                'description' => $freeDocumentDescription,
                'status' => $freeDocumentStatus,
            ];
//            echo "<pre>";
//            print_r($freeDocuments);
//            die;

            $freeDocumentModel = new Document();
            $isInsert = $freeDocumentModel->freeUpdate($freeDocuments,$id);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isInsert) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=document&action=freeIndex");
            exit();
        }
        require_once "views/documents/free/update.php";

    }
    public function feeIndex(){
        $feeDocumentModel=new Document();
        $feeDocuments=$feeDocumentModel->feeGetAll();
        require_once "views/documents/fee/index.php";
    }
    public function feeCreate()
    {
        if (isset($_POST['fee-submit'])){
            $feeDocumentName = $_POST['feeDocumentName'];
            $feeDocumentAvatar = $_FILES['feeDocumentAvatar'];
            $feeDocumentIntroduction = $_POST['feeDocumentIntroduction'];
            $feeDocumentDescription = $_POST['feeDocumentDescription'];
            $feeDocumentStatus = $_POST['feeDocumentStatus'];
            $feeDocumentBanner=$_POST['feeDocumentBanner'];
            $feeDocumentCost=$_POST['feeDocumentCost'];
            $feeDocumentFile=$_FILES['feeDocumentFile'];

//            echo "<pre>";
//            print_r($feeDocumentIntroduction);
//            die;

            if (empty($feeDocumentName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/documents/fee/create.php";
                return;
            }
            if (empty($feeDocumentBanner)) {
                $_SESSION['error'] = "Banner không được để trống";
                require_once "views/documents/fee/create.php";
                return;
            }
            if (empty($feeDocumentCost)) {
                $_SESSION['error'] = "Cost không được để trống";
                require_once "views/documents/fee/create.php";
                return;
            }
            if (empty($feeDocumentAvatar)) {
                $_SESSION['error'] = "Ảnh đại diện tài liệu không được để trống";
                require_once "views/documents/fee/create.php";
                return;

            }
            if (empty($feeDocumentFile)) {
                $_SESSION['error'] = "File tài liệu không được để trống";
                require_once "views/documents/fee/create.php";
                return;

            }
            if (empty($feeDocumentIntroduction)) {
                $_SESSION['error'] = "Phần giới thiệu không được để trống";
                require_once "views/documents/fee/create.php";
                return;

            }

            if ($feeDocumentAvatar['error'] > 0) {
                $_SESSION['error'] = "Upload ảnh thất bại";
                require_once "views/documents/fee/create.php";
                return;
            }
            if ($feeDocumentFile['error'] > 0) {
                $_SESSION['error'] = "Upload File thất bại";
                require_once "views/documents/fee/create.php";
                return;
            }
            if ($feeDocumentAvatar['size'] > 0 && $feeDocumentAvatar['error'] == 0) {
                $extension = pathinfo($feeDocumentAvatar['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                    $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                    require_once "views/documents/fee/create.php";
                    return;
                } else if ($feeDocumentAvatar['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                    require_once "views/documents/fee/create.php";
                    return;
                }
            }
            $feeDocumentAva = '';
            if ($feeDocumentAvatar['size'] > 0 && $feeDocumentAvatar['error'] == 0) {
                $dirUpload = '/imguploads/feeDocumentAvatar';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;

                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload);
                }

                $feeDocumentAvaName = "feeDocumentAva" . time() . $feeDocumentAvatar['name'];
                $isfeeDocumentAvaUpload = move_uploaded_file($feeDocumentAvatar['tmp_name'], $absolutePathUpload . '/' . $feeDocumentAvaName);
                if ($isfeeDocumentAvaUpload) {
                    $feeDocumentAva = $feeDocumentAvaName;
                }
            }
            if ($feeDocumentFile['size'] > 0 && $feeDocumentFile['error'] == 0) {
                $extension = pathinfo($feeDocumentFile['name'], PATHINFO_EXTENSION);
                if (!in_array($extension, ['pdf'])) {
                    $_SESSION['error'] = "File tải lên phải có định dạng PDF";
                    require_once "views/documents/fee/create.php";
                    return;
                }

            }
            $feeDocumentFi = '';
            if ($feeDocumentFile['size'] > 0 && $feeDocumentFile['error'] == 0) {
                $dirUpload = '/files/feeDocumentFile';
                $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;

                if (!file_exists($absolutePathUpload)) {
                    mkdir($absolutePathUpload);
                }

                $feeDocumentFileName = "feeDocumentFile" . time() . $feeDocumentFile['name'];
                $isfeeDocumentFileUpload = move_uploaded_file($feeDocumentFile['tmp_name'], $absolutePathUpload . '/' . $feeDocumentFileName);
                if ($isfeeDocumentFileUpload) {
                    $feeDocumentFi = $feeDocumentFileName;
                }
            }
//            setlocale(LC_MONETARY, 'en_US');
//            $feeDocumentCost=money_format('%i',$feeDocumentCost);
            $feeDocuments = [
                'name' => $feeDocumentName,
                'banner'=>$feeDocumentBanner,

                'cost'=> $feeDocumentCost,
                'file'=>$feeDocumentFi,

                'avatar' => $feeDocumentAva,
                'introduction'=>$feeDocumentIntroduction,
                'description' => $feeDocumentDescription,
                'status' => $feeDocumentStatus,
            ];
//            echo "<pre>";
//            print_r($feeDocuments);
//            die;

            $feeDocumentModel = new Document();
            $isInsert = $feeDocumentModel->feeInsert($feeDocuments);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isInsert) {
                $_SESSION['success'] = "Thêm thành công";
            } else $_SESSION['fail'] = "Thêm thất bại";
            header("Location:index.php?controller=document&action=feeIndex");
            exit();
        }
        require_once "views/documents/fee/create.php";

    }
    public function feeDeleteAll()
    {
        $feeDocumentModel = new Document();
        $isDeleteAll = $feeDocumentModel->feeDeleteAll();
        if ($isDeleteAll) {
            $_SESSION['success'] = "Xóa tất cả thành công";
        } else $_SESSION['fail'] = "Xóa tất cả thất bại";
        require_once "views/documents/fee/index.php";
    }
    public function feeDeleteChecked()
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
                $feeDocumentModel = new Document();
                $isDelete = $feeDocumentModel->feeDeleteChecked($tickedString);
                if ($isDelete) {
                    $_SESSION['success'] = "Xóa thành công";

                } else $_SESSION['fail'] = "Xóa thất bại";
                header("Location:index.php?controller=document&action=feeIndex");
                exit();
            } else {
                $_SESSION['fail'] = "Bạn phải chọn ít nhất 1 mục";
                header("Location:index.php?controller=document&action=feeIndex");
                exit();
            }

        }

    }
    public function feeDetail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $feeDocumentModel = new Document();
        $feeDocument = $feeDocumentModel->feeGetAllByID($id);
        require_once "views/documents/fee/detail.php";

    }
    public function feeDelete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $feeDocumentDelete = new Document();
        $isDelete = $feeDocumentDelete->feeDelete($id);
        if ($isDelete) {
            $_SESSION['success'] = "Xóa dữ liệu thành công";
        } else $_SESSION['fail'] = "Xóa dữ liệu thất bại";
        header("Location:index.php?controller=document&action=feeIndex");
        exit();
    }
    public function feeUpdate()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['fail'] = 'Tham số ID không hợp lệ';
            header("Location: index.php");
            exit();
        }
        $id = $_GET['id'];
        $feeDocumentModel= new Document();
        $feeDocument=$feeDocumentModel->feeGetAllByID($id);

        if (isset($_POST['fee-submit'])){
            $feeDocumentName = $_POST['feeDocumentName'];
            $feeDocumentBanner=$_POST['feeDocumentBanner'];
            $feeDocumentCost=$_POST['feeDocumentCost'];
            $feeDocumentIntroduction = $_POST['feeDocumentIntroduction'];
            $feeDocumentDescription = $_POST['feeDocumentDescription'];
            $feeDocumentStatus = $_POST['feeDocumentStatus'];
            if ($_FILES['feeDocumentAvatar']['error']!=0){
                $feeDocumentAva=$feeDocument['avatar'];


            }
            else $feeDocumentAvatar=$_FILES['feeDocumentAvatar'];
            if ($_FILES['feeDocumentFile']['error']!=0){
                $feeDocumentFi=$feeDocument['file'];


            }
            else $feeDocumentFile=$_FILES['feeDocumentAvatar'];
//            echo "<pre>";
//            print_r($feeDocumentIntroduction);
//            die;

            if (empty($feeDocumentName)) {
                $_SESSION['error'] = "Name không được để trống";
                require_once "views/documents/fee/update.php";
                return;
            }
            if (empty($feeDocumentBanner)) {
                $_SESSION['error'] = "Banner không được để trống";
                require_once "views/documents/fee/update.php";
                return;
            }
            if (empty($feeDocumentCost)) {
                $_SESSION['error'] = "Cost không được để trống";
                require_once "views/documents/fee/update.php";
                return;
            }


            if (empty($feeDocumentIntroduction)) {
                $_SESSION['error'] = "Phần giới thiệu không được để trống";
                require_once "views/documents/fee/update.php";
                return;

            }
            if (isset($feeDocumentAvatar)) {
                if ($feeDocumentAvatar['error'] > 0) {
                    $_SESSION['error'] = "Upload ảnh thất bại";
                    require_once "views/documents/fee/update.php";
                    return;
                }
                if ($feeDocumentAvatar['size'] > 0 && $feeDocumentAvatar['error'] == 0) {
                    $extension = pathinfo($feeDocumentAvatar['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['jpg', 'gif', 'png', 'jpeg', 'JPG'])) {
                        $_SESSION['error'] = "File tải lên phải có định dạng ảnh";
                        require_once "views/documents/fee/update.php";
                        return;
                    } else if ($feeDocumentAvatar['size'] > 2 * 1024 * 1024) {
                        $_SESSION['error'] = "File tải lên phải có dung lượng bé hơn 2Mb";
                        require_once "views/documents/fee/update.php";
                        return;
                    }
                }
                $feeDocumentAva = $feeDocument['avatar'];
                if ($feeDocumentAvatar['size'] > 0 && $feeDocumentAvatar['error'] == 0) {
                    $dirUpload = '/imguploads/feeDocumentAvatar';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
//                    echo "<pre>";
//                    print_r($feeDocumentAva);
//                    die;
                    if (!empty($feeDocumentAva)) {
                        @unlink($absolutePathUpload . '/' . $feeDocumentAva);
                    }

                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload);
                    }

                    $feeDocumentAvaName = "feeDocumentAva" . time() . $feeDocumentAvatar['name'];
                    $isfeeDocumentAvaUpload = move_uploaded_file($feeDocumentAvatar['tmp_name'], $absolutePathUpload . '/' . $feeDocumentAvaName);
                    if ($isfeeDocumentAvaUpload) {
                        $feeDocumentAva = $feeDocumentAvaName;
                    }
                }

            }
            if (isset($feeDocumentFile)) {
                if ($feeDocumentFile['error'] > 0) {
                    $_SESSION['error'] = "Upload File thất bại";
                    require_once "views/documents/fee/update.php";
                    return;
                }
                if ($feeDocumentFile['size'] > 0 && $feeDocumentFile['error'] == 0) {
                    $extension = pathinfo($feeDocumentFile['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, ['pdf'])) {
                        $_SESSION['error'] = "File tải lên phải có định dạng PDF";
                        require_once "views/documents/fee/update.php";
                        return;
                    }
                }
                $feeDocumentFi = $feeDocument['file'];
                if ($feeDocumentFile['size'] > 0 && $feeDocumentFile['error'] == 0) {
                    $dirUpload = '/files/feeDocumentFile';
                    $absolutePathUpload = __DIR__ . '/../assets' . $dirUpload;
//                    echo "<pre>";
//                    print_r($feeDocumentAva);
//                    die;
                    if (!empty($feeDocumentAva)) {
                        @unlink($absolutePathUpload . '/' . $feeDocument);
                    }

                    if (!file_exists($absolutePathUpload)) {
                        mkdir($absolutePathUpload,0777,true);
                    }

                    $feeDocumentFileName = "feeDocumentFile" . time() . $feeDocumentFile['name'];
                    $isfeeDocumentFileUpload = move_uploaded_file($feeDocumentFile['tmp_name'], $absolutePathUpload . '/' . $feeDocumentFileName);
                    if ($isfeeDocumentFileUpload) {
                        $feeDocumentFi = $feeDocumentAvaName;
                    }
                }

            }

            $feeDocuments = [
                'name' => $feeDocumentName,
                'banner'=>$feeDocumentBanner,
                'cost'=>$feeDocumentCost,
                'file'=>$feeDocumentFi,

                'avatar' => $feeDocumentAva,
                'introduction'=>$feeDocumentIntroduction,
                'description' => $feeDocumentDescription,
                'status' => $feeDocumentStatus,
            ];
//            echo "<pre>";
//            print_r($feeDocuments);
//            die;

            $feeDocumentModel = new Document();
            $isInsert = $feeDocumentModel->feeUpdate($feeDocuments,$id);
//                        echo "<pre>";
//            print_r($isInsert);
//            die;
            if ($isInsert) {
                $_SESSION['success'] = "Update thành công";
            } else $_SESSION['fail'] = "Update thất bại";
            header("Location:index.php?controller=document&action=feeIndex");
            exit();
        }
        require_once "views/documents/fee/update.php";

    }
}