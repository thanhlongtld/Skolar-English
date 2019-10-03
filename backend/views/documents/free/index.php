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
        <a class="btn btn-primary" href="index.php?controller=document&action=freeCreate">Thêm mới</a>
        <a class="btn btn-danger" href="index.php?controller=document&action=freeDeleteAll"
           onclick="return confirm('Bạn có chắc muốn xóa hết tất cả dữ liệu không?')">Xóa tất cả dữ liệu </a>

        <br>
        <br>
        <form method="post" enctype="multipart/form-data"
              action="index.php?controller=document&action=freeDeleteChecked">
            <input type="submit" name="checkedValueSubmit" class="btn btn-danger" value="Xóa các mục đã chọn"
                   onclick="return confirm('Bạn có chắc muốn xóa những mục này không?')">
            <br>
            <br>
            <table class="table">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Banner</th>
                    <th>Avatar</th>
                    <th>File</th>
                    <th>Introduction</th>

                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($freeDocuments)): ?>
                    <?php foreach ($freeDocuments as $freeDocument): ?>
                        <tr>
                            <td><input type="checkbox" name="tickButton[]" class="form-control"
                                       value="<?php echo $freeDocument['id']; ?>"></td>
                            <td><?php echo $freeDocument['id']; ?></td>
                            <td><?php echo $freeDocument['name']; ?></td>
                            <td><?php echo $freeDocument['banner']; ?></td>

                            <td><img width="80"
                                     src="assets/imguploads/freeDocumentAvatar/<?php echo $freeDocument['avatar'] ?>">
                            </td>
                            <td><a href="assets/files/freeDocumentFile/<?php echo $freeDocument['file'] ?>"><?php echo $freeDocument['file'] ?></a></td>
                            <td><?php echo $freeDocument['introduction']; ?></td>

                            <td><?php echo $freeDocument['description']; ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($freeDocument['created_at'])); ?></td>
                            <td>
                                <?php
                                switch ($freeDocument['status']) {
                                    case Document::STATUS_ENABLED:
                                        echo "Active";
                                        break;
                                    case Document::STATUS_DISABLED:
                                        echo "Inactive";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <!--        --><?php
                                $urlDetail = "index.php?controller=document&action=freeDetail&id=" . $freeDocument['id'];
                                $urlUpdate = "index.php?controller=document&action=freeUpdate&id=" . $freeDocument['id'];
                                $urlDelete = "index.php?controller=document&action=freeDelete&id=" . $freeDocument['id'];
                                //        ?>
                                <a href="<?php echo $urlDetail ?>"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo $urlUpdate ?>"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo $urlDelete ?>"
                                   onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ko?')"><i
                                            class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>