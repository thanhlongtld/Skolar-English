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
              action="index.php?controller=order&action=orderUpdate">
                <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
            <br>
            <br>

            <table class="table">
                <tr>


                    <th>Order ID</th>
                    <th>Name</th>

                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Ship</th>
                    <th>Total</th>
                    <th>Condition</th>
                    <th>Created At</th>


                </tr>

                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>

                        <tr>

                            <td><?php echo $order['id']; ?></td>

                            <td><?php echo $order['buyer_name']; ?></td>

                            <td><?php echo $order['product']; ?></td>

                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo $order['ship']; ?></td>
                            <td><?php
                               $total=(int)$order['total']+(int)$order['ship'];
                               echo $total;
                                ?></td>
                            <?php if ($order['condition']==Order::CONDITION_NSHIPED):?>
                            <td>


                            <input type="checkbox" name="condition[]" value="<?php echo $order['id'] ?>"> Đã giao
                            </td>
                            <?php else: ?>
                            <td>Đã nhận</td>
                            <?php endif;?>

                            <td><?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])); ?></td>


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