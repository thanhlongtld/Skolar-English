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
            <input class="form-control" type="text" name="onlineMain"
                   value="<?php echo isset($_POST['onlineMain']) ? $_POST['onlineMain'] : $online[0]['main_banner'] ?>">
            <label style="font-weight: bold">Extra banner:</label>
            <textarea id="online-extra" class="form-control" name="onlineExtra" autofocus>
                <?php echo isset($_POST['onlineExtra']) ? $_POST['onlineExtra']: $online[0]['extra_banner'] ?>
            </textarea>
            <label style="font-weight: bold">Video:</label>
            <textarea class="form-control" name="onlineVideo" autofocus>
                <?php echo isset($_POST['onlineVideo']) ? $_POST['onlineVideo']: $online[0]['video'] ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="online-description" class="form-control" name="onlineDescription" autofocus>
                <?php echo isset($_POST['onlineDescription']) ? $_POST['onlineDescription']: $online[0]['description'] ?>
            </textarea>
            <label>Status</label>
            <?php
            $onlineStatus=isset($_POST['onlineStatus']) ? $_POST['onlineStatus'] : $online[0]['status'];

            $selectedStatusEnabled='';
            switch ($onlineStatus){
                case Mode::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                case Mode::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
            }

            ?>
            <select class="form-control" name="onlineStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Mode::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Mode::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="online-submit">
            <a href="index.php?controller=mode&action=onlineIndex" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>