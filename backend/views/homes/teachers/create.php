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
            <input class="form-control" type="text" name="teacherName"
                   value="<?php echo isset($_POST['teacherName']) ? $_POST['teacherName'] : "" ?>">
            <label style="font-weight: bold">Date of birth:</label>
            <input class="form-control" type="date" name="teacherDateOfBirth"
                   value="<?php echo isset($_POST['teacherDateOfBirth']) ? $_POST['teacherDateOfBirth'] : "" ?>">
            <label style="font-weight: bold">Position:</label>
            <input class="form-control" type="text" name="teacherPosition"
                   value="<?php echo isset($_POST['teacherPosition']) ? $_POST['teacherPosition'] : "" ?>">
            <label style="font-weight: bold">Avatar:</label>
            <input class="form-control" type="file" name="teacherAvatar">
            <label style="font-weight: bold">Facebook:</label>
            <input class="form-control" type="text" name="teacherFacebook"
                   value="<?php echo isset($_POST['teacherFacebook']) ? $_POST['teacherFacebook'] : "" ?>">
            <label style="font-weight: bold">Instagram:</label>
            <input class="form-control" type="text" name="teacherInstagram"
                   value="<?php echo isset($_POST['teacherInstagram']) ? $_POST['teacherInstagram'] : "" ?>">
            <label style="font-weight: bold">Twitter:</label>
            <input class="form-control" type="text" name="teacherTwitter"
                   value="<?php echo isset($_POST['teacherTwitter']) ? $_POST['teacherTwitter'] : "" ?>">
            <label style="font-weight: bold">Achievement:</label>
            <textarea id="teacher-achievement" class="form-control" name="teacherAchievement" autofocus>
                <?php echo isset($_POST['teacherAchievement']) ? $_POST['teacherAchievement']: "" ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="teacher-description" class="form-control" name="teacherDescription" autofocus>
                <?php echo isset($_POST['teacherDescription']) ? $_POST['teacherDescription']: "" ?>
            </textarea>
            <label>Status</label>
            <?php
            $selectedStatusEnabled = '';
            $selectedStatusDisabled = '';
            if (isset($_POST['contactStatus'])){

                switch ($_POST['contactStatus']){
                    case Teacher::STATUS_ENABLED:
                        $selectedStatusEnabled = "selected=true";
                        break;
                    case Teacher::STATUS_DISABLED:
                        $selectedStatusDisabled = "selected=true";
                        break;
                }
            }
            ?>
            <select class="form-control" name="teacherStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Teacher::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Teacher::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="teacher-submit">
            <a href="index.php?controller=teacher&action=index" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>