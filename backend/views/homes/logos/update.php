<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];?>
                <?php unset($_SESSION['error']);?>
            </div>
        <?php endif;?>
        <h3>Thay đổi logo (File định dạng ảnh, dung lượng không vượt quá 2MB)</h3>
        <form class="form-group" method="post" enctype="multipart/form-data" action="">

            <input type="file" class="form-control" name="logo">
            <br>

            <input type="submit" class="btn btn-success" value="Save" name="logo-submit">
            <a href="index.php?controller=logo&action=index" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>