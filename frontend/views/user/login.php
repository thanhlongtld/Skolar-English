<?php include_once 'views/layouts/header.php' ?>
<?php include_once "views/user/slide.php";?>
<!-- Main content -->
<div class="form-login container">
    <?php if (isset($_SESSION['fail'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php
            //nơi hiển thị thông báo lỗi nếu có
            //sau khi thông báo lỗi xong cần xóa session này đi, để tránh việc hiển thị lại sau mỗi lần
            //            refresh trang
            echo $_SESSION['fail'];
            unset($_SESSION['fail']);
            ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php
            //nơi hiển thị thông báo thành công nếu có
            //sau khi thông báo thành công xong cần xóa session này đi, để tránh việc hiển thị lại sau mỗi lần
            //            refresh trang
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>
    <h1>Đăng nhập</h1>
    <form action="" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password"/>
        </div>
        <div class="form-group">
            <input type="checkbox" name="saveUser"> Ghi nhớ thông tin đăng nhập
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
            <a class="btn btn-light" href="index.php?controller=home&action=index">Cancel</a>
        </div>
        <div class="form-group">
            <p>Bạn chưa có tài khoản Skolar?</p>
            <a class="btn btn-primary" href="index.php?controller=user&action=create">Đăng kí</a>
        </div>

    </form>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
