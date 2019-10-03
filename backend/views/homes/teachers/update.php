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
                   value="<?php echo isset($_POST['teacherName']) ? $_POST['teacherName'] : $teacher['name'] ?>">
            <label style="font-weight: bold">Date of birth:</label>
            <input class="form-control" type="date" name="teacherDateOfBirth"
                   value="<?php echo isset($_POST['teacherDateOfBirth']) ? $_POST['teacherDateOfBirth'] : $teacher['date_of_birth'] ?>">
            <label style="font-weight: bold">Position:</label>
            <input class="form-control" type="text" name="teacherPosition"
                   value="<?php echo isset($_POST['teacherPosition']) ? $_POST['teacherPosition'] : $teacher['position'] ?>">
            <label style="font-weight: bold">Avatar:</label>
            <input class="form-control" type="file" name="teacherAvatar">
            <?php if (!empty($teacher['avatar'])): ?>
                <img
                    src="assets/imguploads/teacherAvatar/<?php echo $teacher['avatar'] ?>"
                    width="80px" />
            <?php endif; ?>
            <br>
            <label style="font-weight: bold">Facebook:</label>
            <input class="form-control" type="text" name="teacherFacebook"
                   value="<?php echo isset($_POST['teacherFacebook']) ? $_POST['teacherFacebook'] : $teacher['facebook'] ?>">
            <label style="font-weight: bold">Instagram:</label>
            <input class="form-control" type="text" name="teacherInstagram"
                   value="<?php echo isset($_POST['teacherInstagram']) ? $_POST['teacherInstagram'] : $teacher['instagram'] ?>">
            <label style="font-weight: bold">Twitter:</label>
            <input class="form-control" type="text" name="teacherTwitter"
                   value="<?php echo isset($_POST['teacherTwitter']) ? $_POST['teacherTwitter'] : $teacher['twitter'] ?>">
            <label style="font-weight: bold">Achievement:</label>
            <textarea id="teacher-achievement" class="form-control" name="teacherAchievement" autofocus>
                <?php echo isset($_POST['teacherAchievement']) ? $_POST['teacherAchievement']: $teacher['achievement'] ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="teacher-description" class="form-control" name="teacherDescription" autofocus>
                <?php echo isset($_POST['teacherDescription']) ? $_POST['teacherDescription']: $teacher['description'] ?>
            </textarea>
            <label>Status</label>
            <?php
            $selectedStatusEnabled = '';
            $selectedStatusDisabled = '';
            $statusTeacher= isset($_POST['teacherStatus'])? $_POST['teacherStatus'] : $teacher['status'];


            switch ($statusTeacher){
                case Teacher::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                case Teacher::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
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