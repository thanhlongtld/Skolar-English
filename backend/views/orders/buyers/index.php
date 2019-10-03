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
        <form method="post" enctype="multipart/form-data"
              action="">

            <br>
            <br>
            <table class="table">
                <tr>

                    <th>Buyer ID</th>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Address</th>

                    <th>City</th>
                    <th>Method</th>
                    <th>Bank Number</th>
                    <th>Bank</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Chi tiết</th>
                </tr>

                <?php if (!empty($buyers)): ?>
                    <?php foreach ($buyers as $buyer): ?>
                        <tr>
                           
                            <td><?php echo $buyer['id']; ?></td>
                            <td><?php echo $buyer['order_id']; ?></td>
                            <td><?php echo $buyer['name']; ?></td>

                            <td><?php echo $buyer['number']; ?></td>

                            <td><?php echo $buyer['mail']; ?></td>
                            <td><?php echo $buyer['address']; ?></td>
                            <td><?php echo $buyer['city']; ?></td>
                            <td><?php echo $buyer['method']; ?></td>
                            <td><?php echo $buyer['bank_number']; ?></td>
                            <td><?php echo $buyer['bank']; ?></td>
                            <td><?php echo $buyer['message']; ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($buyer['created_at'])); ?></td>

                            <td>
                                <!--        --><?php
                                $urlDetail = "index.php?controller=order&action=buyerDetail&id=" . $buyer['id'];

                                //        ?>
                                <a href="<?php echo $urlDetail ?>"><i class="fa fa-eye"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>