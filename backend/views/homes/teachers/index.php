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
        <a class="btn btn-primary" href="index.php?controller=teacher&action=create">Thêm mới thông tin giảng viên</a>
        <a class="btn btn-danger" href="index.php?controller=teacher&action=deleteAll" onclick="return confirm('Bạn có chắc muốn xóa hết tất cả dữ liệu không?')">Xóa tất cả dữ liệu </a>

        <br>
        <br>
        <form method="post" enctype="multipart/form-data" action="index.php?controller=teacher&action=deleteChecked">
            <input type="submit" name="checkedValueSubmit" class="btn btn-danger" value="Xóa các mục đã chọn" onclick="return confirm('Bạn có chắc muốn xóa những mục này không?')" >
            <br>
            <br>
            <table class="table">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birthday (Y-M-D)</th>
                    <th>Position</th>
                    <th>Avatar</th>
                    <th>Facebook</th>
                    <th>Instagram</th>
                    <th>Twitter</th>

                    <th>Achievement</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php if (!empty($teachers)): ?>
                    <?php foreach ($teachers as $teacher): ?>
                        <tr>
                            <td width="40px"><input type="checkbox" name="tickButton[]" class="form-control" value="<?php echo $teacher['id'];?>" ></td>
                            <td><?php echo $teacher['id'];?></td>
                            <td><?php echo $teacher['name'];?></td>
                            <td><?php echo $teacher['date_of_birth'];?></td>
                            <td><?php echo $teacher['position'];?></td>
                            <td><img width="80" src="assets/imguploads/teacherAvatar/<?php echo $teacher['avatar']?>"></td>
                            <td><?php echo $teacher['facebook'];?></td>
                            <td><?php echo $teacher['instagram'];?></td>
                            <td><?php echo $teacher['twitter'];?></td>
                            <td><?php echo $teacher['achievement'];?></td>



                            <td><?php echo $teacher['description'];?></td>
                            <td><?php echo date('d-m-Y H:i:s',strtotime($teacher['created_at']));?></td>
                            <td>
                                <?php
                                switch ($teacher['status']){
                                    case Teacher::STATUS_ENABLED: echo "Active";
                                        break;
                                    case Teacher::STATUS_DISABLED: echo "Inactive";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <!--        --><?php
                                $urlDetail="index.php?controller=teacher&action=detail&id=".$teacher['id'];
                                $urlUpdate="index.php?controller=teacher&action=update&id=".$teacher['id'];
                                $urlDelete="index.php?controller=teacher&action=delete&id=".$teacher['id'];
                                //        ?>
                                <a href="<?php echo $urlDetail?>"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo $urlUpdate?>"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo $urlDelete?>" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ko?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else:?>
                    <tr>
                        <td colspan="13" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>