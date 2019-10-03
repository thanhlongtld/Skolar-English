<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 4:53 PM
 */
require_once "views/layouts/header.php";
?>
<main class="app-content">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success'] ?>
            <?php unset($_SESSION['success']); ?>
        </div>

    <?php endif; ?>
    <?php if (isset($_SESSION['fail'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['fail'] ?>
            <?php unset($_SESSION['fail']); ?>
        </div>

    <?php endif; ?>
    <a class="btn btn-primary" href="index.php?controller=logo&action=update">Thay đổi Logo</a>
    <h1>Logo đang sử dụng</h1>
    <table class="table">
        <tr>
            <td>ID</td>
            <td>Tên ảnh</td>
            <td>Ảnh</td>
            <td>Ngày tạo</td>
            <td>Tình trạng</td>
        </tr>
        <tr>
            <td><?php echo $logo[0]['id']; ?></td>
            <td><?php echo $logo[0]['logo_name'] ?></td>
            <td><img src="assets/imguploads/logo/<?php echo $logo[0]['logo_name']?>" width="80px"></td>
            <td><?php echo date("d-m-Y H:i:s", strtotime($logo[0]['created_at'])) ?></td>
            <td><?php switch ($logo[0]['status']){
                    case Logo::STATUS_ENABLED: echo "Active"; break;
                    case Logo::STATUS_DISABLED: echo "Inactive"; break;
                }

                ?></td>

        </tr>
    </table>
</main>
<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 4:53 PM
 */
require_once "views/layouts/footer.php";
?>

