<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];?>
                <?php unset($_SESSION['error']);?>
            </div>
        <?php endif;?>
        <h1>Bảng thêm mới dữ liệu:</h1>
        <form class="form-group" method="post" enctype="multipart/form-data" action="">
            <label style="font-weight: bold">Name:</label>
            <input class="form-control" type="text" name="infoName"
                   value="<?php echo isset($_POST['infoName']) ? $_POST['infoName'] : "" ?>">
            <label style="font-weight: bold">Value:</label>
            <textarea id="info-value" class="form-control" name="infoValue" autofocus>
                <?php echo isset($_POST['infoValue']) ? $_POST['infoValue']: "" ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="info-description" class="form-control" name="infoDescription" autofocus>
                <?php echo isset($_POST['infoDescription']) ? $_POST['infoDescription']: "" ?>
            </textarea>
            <label>Status</label>
            <?php
            $selectedStatusEnabled = '';
            $selectedStatusDisabled = '';
            if (isset($_POST['infoStatus'])){

                switch ($_POST['infoStatus']){
                    case Info::STATUS_ENABLED:
                        $selectedStatusEnabled = "selected=true";
                        break;
                    case Info::STATUS_DISABLED:
                        $selectedStatusDisabled = "selected=true";
                        break;
                }
            }
            ?>
            <select class="form-control" name="infoStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Info::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Info::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="info-submit">
            <a href="index.php?controller=info&action=index" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>