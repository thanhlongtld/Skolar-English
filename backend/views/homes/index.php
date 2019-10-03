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
    <h1>Nội dung hiển thị ở đây
    </h1>
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
