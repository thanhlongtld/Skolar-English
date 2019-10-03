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
            <label style="font-weight: bold">Main banner:</label>
            <input class="form-control" type="text" name="offlineMain"
                   value="<?php echo isset($_POST['offlineMain']) ? $_POST['offlineMain'] : $offline[0]['main_banner'] ?>">
            <label style="font-weight: bold">Extra banner:</label>
            <textarea id="offline-extra" class="form-control" name="offlineExtra" autofocus>
                <?php echo isset($_POST['offlineExtra']) ? $_POST['offlineExtra']: $offline[0]['extra_banner'] ?>
            </textarea>
            <label style="font-weight: bold">Video:</label>
            <textarea class="form-control" name="offlineVideo" autofocus>
                <?php echo isset($_POST['offlineVideo']) ? $_POST['offlineVideo']: $offline[0]['video'] ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="offline-description" class="form-control" name="offlineDescription" autofocus>
                <?php echo isset($_POST['offlineDescription']) ? $_POST['offlineDescription']: $offline[0]['description'] ?>
            </textarea>
            <label>Status</label>
            <?php
            $offlineStatus=isset($_POST['offlineStatus']) ? $_POST['offlineStatus'] : $offline[0]['status'];

            $selectedStatusEnabled='';
            switch ($offlineStatus){
                case Mode::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                case Mode::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
            }

            ?>
            <select class="form-control" name="offlineStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Mode::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Mode::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="offline-submit">
            <a href="index.php?controller=mode&action=offlineIndex" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>