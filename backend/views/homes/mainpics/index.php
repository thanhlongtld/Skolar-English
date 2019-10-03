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
    <a class="btn btn-primary" href="index.php?controller=mainpic&action=update">Thay đổi Ảnh chính</a>
    <h1>Ảnh chính đang sử dụng</h1>
    <?php if (!empty($mainPic)):?>
    <table class="table">
        <tr>
            <td>ID</td>
            <td>Tên ảnh</td>
            <td>Ảnh</td>
            <td>Ngày tạo</td>
            <td>Tình trạng</td>
        </tr>
        <tr>
            <td><?php echo $mainPic[0]['id']; ?></td>
            <td><?php echo $mainPic[0]['name'] ?></td>
            <td><img width="80px" src="assets/imguploads/mainpic/<?php echo $mainPic[0]['name']?>"></td>
            <td><?php echo date("d-m-Y H:i:s", strtotime($mainPic[0]['created_at'])) ?></td>
            <td><?php switch ($mainPic[0]['status']){
                    case Mainpic::STATUS_ENABLED: echo "Active"; break;
                    case Mainpic::STATUS_DISABLED: echo "Inactive"; break;
                }

                ?></td>

        </tr>
    </table>
    <?php else: ?>
    <h3>Chưa có ảnh chính để hiển thị</h3>
    <?php endif;?>
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

