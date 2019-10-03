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

        <h1>Bảng quản lí video giới thiệu</h1>

        <br>
        <br>
        <form method="post" enctype="multipart/form-data" action="index.php?controller=video&action=deleteChecked">

            <br>
            <br>
            <table class="table">
                <tr>

                    <th>ID</th>

                    <th>Value</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($video)): ?>

                    <tr>

                        <td><?php echo $video[0]['id'];?></td>

                        <td><?php echo $video[0]['value'];?></td>
                        <td><?php echo $video[0]['description'];?></td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($video[0]['created_at']));?></td>
                        <td>
                            <?php
                            switch ($video[0]['status']){
                                case Video::STATUS_ENABLED: echo "Active";
                                    break;
                                case Video::STATUS_DISABLED: echo "Inactive";
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <!--        --><?php
                            $urlDetail="index.php?controller=video&action=detail&id=".$video[0]['id'];
                            $urlUpdate="index.php?controller=video&action=update&id=".$video[0]['id'];

                            //        ?>
                            <a href="<?php echo $urlDetail?>"><i class="fa fa-eye"></i></a>
                            <a href="<?php echo $urlUpdate?>"><i class="fa fa-pencil"></i></a>

                        </td>
                    </tr>

                <?php else:?>
                    <tr>
                        <td colspan="8" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>