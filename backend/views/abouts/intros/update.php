<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];?>
                <?php unset($_SESSION['error']);?>
            </div>
        <?php endif;?>
        <h1>Bảng chỉnh sửa dữ liệu:</h1>
        <form class="form-group" method="post" enctype="multipart/form-data" action="">

            <label style="font-weight: bold">Value:</label>
            <textarea id="intro-value" class="form-control" name="introValue" autofocus>
                <?php echo isset($_POST['introValue']) ? $_POST['introValue']: $intro[0]['value'] ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="intro-description" class="form-control" name="introDescription" autofocus>
                <?php echo isset($_POST['introDescription']) ? $_POST['introDescription']: $intro[0]['description'] ?>
            </textarea>
            <label>Status</label>
            <?php
            $introStatus=isset($_POST['introStatus']) ? $_POST['introStatus'] : $intro[0]['status'];

            $selectedStatusEnabled='';
            switch ($introStatus){
                case Intro::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                case Intro::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
            }

            ?>
            <select class="form-control" name="introStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Intro::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Intro::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="intro-submit">
            <a href="index.php?controller=intro&action=index" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>