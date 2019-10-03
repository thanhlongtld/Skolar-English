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
            <textarea id="video-value" class="form-control" name="videoValue" autofocus>
                <?php echo isset($_POST['videoValue']) ? $_POST['videoValue']: $video[0]['value'] ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="video-description" class="form-control" name="videoDescription" autofocus>
                <?php echo isset($_POST['videoDescription']) ? $_POST['videoDescription']: $video[0]['description'] ?>
            </textarea>
            <label>Status</label>
            <?php
            $videoStatus=isset($_POST['videoStatus']) ? $_POST['videoStatus'] : $video[0]['status'];

            $selectedStatusEnabled='';
            switch ($videoStatus){
                case Video::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                case Video::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
            }

            ?>
            <select class="form-control" name="videoStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Video::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Video::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="video-submit">
            <a href="index.php?controller=video&action=index" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>