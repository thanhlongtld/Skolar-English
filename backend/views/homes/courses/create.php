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
            <input class="form-control" type="text" name="courseName"
                   value="<?php echo isset($_POST['courseName']) ? $_POST['courseName'] : "" ?>">
            <label style="font-weight: bold">Number of student:</label>
            <input class="form-control" type="number" name="courseNumberStudent" min="0" max="1000"
                   value="<?php echo isset($_POST['courseNumberStudent']) ? $_POST['courseNumberStudent'] : "" ?>">
            <label style="font-weight: bold">Maximum of number of students:</label>
            <input class="form-control" type="number" name="courseNumberStudentMax" min="0" max="1000"
                   value="<?php echo isset($_POST['courseNumberStudentMax']) ? $_POST['courseNumberStudentMax'] : "" ?>">
            <label style="font-weight: bold">Teacher:</label>
            <input class="form-control" type="text" name="courseTeacher"
                   value="<?php echo isset($_POST['courseTeacher']) ? $_POST['courseTeacher'] : "" ?>">
            <label style="font-weight: bold">Avatar:</label>
            <input type="file" class="form-control" name="courseAvatar">
            <?php
            $selectedTypeBig = '';
            $selectedTypeSmall = '';
            $selectedTypeThin = '';
            if (isset($_POST['courseType'])){

                switch ($_POST['courseType']){
                    case Course::COURSE_THIN:
                        $selectedTypeThin = "selected=true";
                        break;
                    case Course::COURSE_BIG:
                        $selectedTypeBig = "selected=true";
                        break;
                    case Course::COURSE_SMALL:
                        $selectedTypeSmall = "selected=true";
                        break;
                }
            }
            ?>
            <label>Type</label>
            <select class="form-control" name="courseType">

                <option <?php echo $selectedTypeThin?> value="<?php echo Course::COURSE_THIN ?>">Thẳng đứng</option>
                <option  <?php echo $selectedTypeBig ?> value="<?php echo Course::COURSE_BIG ?>">Ngang To</option>
                <option  <?php echo $selectedTypeSmall ?> value="<?php echo Course::COURSE_SMALL ?>">Ngang Nhỏ</option>
            </select>
            <label style="font-weight: bold">Description:</label>
            <textarea id="contact-description" class="form-control" name="courseDescription" autofocus>
                <?php echo isset($_POST['courseDescription']) ? $_POST['courseDescription']: "" ?>
            </textarea>

            <?php
            $selectedStatusEnabled = '';
            $selectedStatusDisabled = '';
            if (isset($_POST['courseStatus'])){

                switch ($_POST['courseStatus']){
                    case Course::STATUS_ENABLED:
                        $selectedStatusEnabled = "selected=true";
                        break;
                    case Course::STATUS_DISABLED:
                        $selectedStatusDisabled = "selected=true";
                        break;
                }
            }
            ?>
            <label>Status</label>
            <select class="form-control" name="courseStatus">

                <option <?php echo $selectedStatusEnabled?> value="<?php echo Course::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?> value="<?php echo Course::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="course-submit">
            <a href="index.php?controller=course&action=index" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>