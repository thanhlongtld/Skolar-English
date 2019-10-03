<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success'] ?>
                <?php unset($_SESSION['success']); ?>
            </div>

        <?php endif; ?>
        <?php if (isset($_SESSION['fail'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['fail'] ?>
                <?php unset($_SESSION['fail']); ?>
            </div>

        <?php endif; ?>
        <a class="btn btn-primary" href="index.php?controller=course&action=create">Thêm mới khóa học</a>
        <a class="btn btn-danger" href="index.php?controller=course&action=deleteAll" onclick="return confirm('Bạn có chắc muốn xóa hết tất cả dữ liệu không?')">Xóa tất cả dữ liệu </a>

        <br>
        <br>
        <form method="post" enctype="multipart/form-data" action="index.php?controller=course&action=deleteChecked">
            <input type="submit" name="checkedValueSubmit" class="btn btn-danger" value="Xóa các mục đã chọn" onclick="return confirm('Bạn có chắc muốn xóa những mục này không?')" >
            <br>
            <br>
            <table class="table">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number of students</th>
                    <th>Maximim students</th>
                    <th>Teacher</th>
                    <th>Avatar</th>
                    <th>Type</th>

                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><input type="checkbox" name="tickButton[]" class="form-control" value="<?php echo $course['id'];?>"></td>
                            <td><?php echo $course['id'];?></td>
                            <td><?php echo $course['name'];?></td>
                            <td><?php echo $course['number_of_student'];?></td>
                            <td><?php echo $course['max_number_student'];?></td>
                            <td><?php echo $course['teacher'];?></td>
                            <td><img width="80" src="assets/imguploads/courseAvatar/<?php echo $course['avatar']?>"></td>
                            <td>
                                <?php
                                switch ($course['type']){
                                    case Course::COURSE_THIN: echo "Thẳng đứng";
                                        break;
                                    case Course::COURSE_BIG: echo "Ngang To";
                                        break;
                                    case Course::COURSE_SMALL: echo "Ngang Nhỏ";
                                        break;
                                }
                                ?>
                            </td>
                            <td><?php echo $course['description'];?></td>
                            <td><?php echo date('d-m-Y H:i:s',strtotime($course['created_at']));?></td>
                            <td>
                                <?php
                                switch ($course['status']){
                                    case Course::STATUS_ENABLED: echo "Active";
                                        break;
                                    case Course::STATUS_DISABLED: echo "Inactive";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <!--        --><?php
                                $urlDetail="index.php?controller=course&action=detail&id=".$course['id'];
                                $urlUpdate="index.php?controller=course&action=update&id=".$course['id'];
                                $urlDelete="index.php?controller=course&action=delete&id=".$course['id'];
                                //        ?>
                                <a href="<?php echo $urlDetail?>"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo $urlUpdate?>"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo $urlDelete?>" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ko?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else:?>
                    <tr>
                        <td colspan="11" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>