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

        <h1>Bảng quản lí đoạn text giới thiệu</h1>

        <br>
        <br>
        <form method="post" enctype="multipart/form-data" action="index.php?controller=video&action=deleteChecked">

            <br>
            <br>
            <table class="table">
                <tr>

                    <th>ID</th>

                    <th>Main Banner</th>
                    <th>Extra Banner</th>
                    <th>Video</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($online)): ?>

                    <tr>

                        <td><?php echo $online[0]['id'];?></td>
                        <td><?php echo $online[0]['main_banner'];?></td>

                        <td><?php echo $online[0]['extra_banner'];?></td>
                        <td><?php echo $online[0]['video'];?></td>
                        <td><?php echo $online[0]['description'];?></td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($online[0]['created_at']));?></td>
                        <td>
                            <?php
                            switch ($online[0]['status']){
                                case Mode::STATUS_ENABLED: echo "Active";
                                    break;
                                case Mode::STATUS_DISABLED: echo "Inactive";
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <!--        --><?php
                            $urlDetail="index.php?controller=mode&action=onlineDetail&id=".$online[0]['id'];
                            $urlUpdate="index.php?controller=mode&action=onlineUpdate&id=".$online[0]['id'];

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