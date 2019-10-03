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
    <h1>Cập nhật thông tin: </h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>First name: </label>
            <input type="text" class="form-control" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : $userInfo['firstname'] ?>"/>
        </div>
        <div class="form-group">
            <label>Last name: </label>
            <input type="text" class="form-control" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : $userInfo['lastname'] ?>"/>
        </div>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : $userInfo['username'] ?>"/>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password"/>
        </div>
        <div class="form-group">
            <label>Avatar:</label>
            <input class="form-control" type="file" name="avatar">
            <img width="100px" src="assets/imguploads/avatar/<?php echo $userInfo['avatar']; ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Update" class="btn btn-primary"/>
            <a class="btn btn-light" href="index.php?controller=home&action=index">Cancel</a>
        </div>


    </form>
</div>

<!-- /.content -->
<!-- /.content-wrapper -->
<?php include_once 'views/layouts/footer.php' ?>
