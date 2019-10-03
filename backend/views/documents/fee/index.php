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
        <a class="btn btn-primary" href="index.php?controller=document&action=feeCreate">Thêm mới</a>
        <a class="btn btn-danger" href="index.php?controller=document&action=feeDeleteAll"
           onclick="return confirm('Bạn có chắc muốn xóa hết tất cả dữ liệu không?')">Xóa tất cả dữ liệu </a>

        <br>
        <br>
        <form method="post" enctype="multipart/form-data"
              action="index.php?controller=document&action=feeDeleteChecked">
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
                    <th>Cost</th>
                    <th>Introduction</th>

                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($feeDocuments)): ?>
                    <?php foreach ($feeDocuments as $feeDocument): ?>
                        <tr>
                            <td><input type="checkbox" name="tickButton[]" class="form-control"
                                       value="<?php echo $feeDocument['id']; ?>"></td>
                            <td><?php echo $feeDocument['id']; ?></td>
                            <td><?php echo $feeDocument['name']; ?></td>
                            <td><?php echo $feeDocument['banner']; ?></td>

                            <td><img width="80"
                                     src="assets/imguploads/feeDocumentAvatar/<?php echo $feeDocument['avatar'] ?>">
                            </td>
                            <td><a href="assets/files/feeDocumentFile/<?php echo $feeDocument['file'] ?>"><?php echo $feeDocument['file'] ?></a></td>
                            <td><?php
                                $controller=new Controller();
                                $feeDocumentCost= $controller->my_money_format($feeDocument['cost']);
                                echo $feeDocumentCost;
                                ?></td>
                            <td><?php echo $feeDocument['introduction']; ?></td>

                            <td><?php echo $feeDocument['description']; ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($feeDocument['created_at'])); ?></td>
                            <td>
                                <?php
                                switch ($feeDocument['status']) {
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
                                $urlDetail = "index.php?controller=document&action=feeDetail&id=" . $feeDocument['id'];
                                $urlUpdate = "index.php?controller=document&action=feeUpdate&id=" . $feeDocument['id'];
                                $urlDelete = "index.php?controller=document&action=feeDelete&id=" . $feeDocument['id'];
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
                        <td colspan="9" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>