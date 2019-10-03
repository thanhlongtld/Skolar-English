<?php include_once "views/layouts/header.php"; ?>
<?php include_once "views/cart/slide.php"; ?>
    <h1 style="text-align: center">Giỏ hàng của bạn</h1>
<?php $count = 1;
$_SESSION['total'] = 0;
?>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Giá</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thành tiền</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php if (isset($_SESSION['select'])):
//            echo "<pre>";
//            print_r($_SESSION['select']);
//            echo "</pre>";
//        die;
            ?>
            <form method="post" action="index.php?controller=cart&action=buy">
                <?php foreach ($_SESSION['select'] as $selectedCart): ?>


                        <tr>
                            <th scope="row">
                                <?php
                                echo $count;
                                $count++;
                                ?>
                            </th>
                            <td><?php echo $selectedCart['name']; ?></td>

                            <td><?php echo $selectedCart['cost']; ?></td>
                            <td><input type="number" class="form-control"
                                       name="number[<?php echo $selectedCart['id'] ?>] ?>]"
                                       value="<?php echo isset($_POST['number'][$selectedCart['id']]) ? $_POST['number'][$selectedCart['id']] : 1 ?>"
                                       min="1"></td>
                            <td><?php echo $_SESSION['eachTotal'][$selectedCart['id']]; ?></td>
                            <td>
                                <a href="index.php?controller=cart&action=delete&number=<?php echo $count - 2; ?>">Xóa</a>
                            </td>
                        </tr>

                    <?php
                        $_SESSION['total'] += $_SESSION['eachTotal'][$selectedCart['id']];
                    $_SESSION['eachTotal'][$selectedCart['id']]/=$_SESSION['quantity'][$selectedCart['id']];
//                print_r($_SESSION['eachTotal']);
                        ?>

                <?php endforeach; ?>
                <tr>
                    <td colspan="6" style="text-align: right">Tổng tiền: <?php echo $_SESSION['total']; ?></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <button type="submit" class="btn btn-primary" name="checkCostSubmit">Cập nhật lại giá tiền
                        </button>
                    </td>

                </tr>
                <tr>
                    <td colspan="6">
                        <button type="submit" class="btn btn-primary" name="cartSubmit">Mua hàng
                        </button>
                    </td>
                </tr>
            </form>
        <?php else: ?>
            <tr>
                <td colspan="6">Chưa có gì trong giở hàng của bạn</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
<?php $count = 1;
$_SESSION['costTotal']=$_SESSION['total'];
$_SESSION['total']=0;
?>
<?php include_once "views/layouts/footer.php"; ?>