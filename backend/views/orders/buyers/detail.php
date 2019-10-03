<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Dữ liệu người mua hàng</h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $buyerDetail[0]['buyer']; ?></td>
            </tr>
            <tr>
                <td>Order ID</td>
                <td><?php echo $buyerDetail[0]['orders_id']; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $buyerDetail[0]['name']; ?></td>
            </tr>

            <tr>
                <td>Number</td>
                <td><?php echo $buyerDetail[0]['number']; ?></td>
            </tr>
            <tr>
                <td>Mail</td>
                <td><?php echo $buyerDetail[0]['mail'] ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $buyerDetail[0]['address']; ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?php
                    switch ($buyerDetail[0]['city']) {
                        case Order::ID_HN:
                            echo "Hà Nội";
                            break;
                        case Order::ID_HP:
                            echo "Hải Phòng";
                            break;
                        case Order::ID_SG:
                            echo "Sài Gòn";
                            break;
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Method</td>
                <td><?php
                    switch ($buyerDetail[0]['method']) {
                        case Order::METHOD_COD:
                            echo "Cod";
                            break;
                        case Order::METHOD_BANK:
                            echo "Chuyển khoản";
                            break;

                    }
                    ?></td>
            </tr>
            <tr>
                <td>Bank Number</td>
                <td><?php echo $buyerDetail[0]['bank_number']; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $buyerDetail[0]['bank']; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $buyerDetail[0]['message']; ?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo date("d-m-Y H:i:s", strtotime($buyerDetail[0]['created_at'])); ?></td>
            </tr>

        </table>
        <h1>Chi tiết đơn hàng</h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $buyerDetail[0]['orders_id'] ?></td>
            </tr>
            <tr>
                <td>Chi tiết đơn hàng</td>
                <td>

                    <?php foreach ($productDetail

                    as $product): ?>
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td><?php $product['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Avatar</td>
                            <td><img width="300" src="assets/imguploads/feeDocumentAvatar/<?php echo $product['avatar']; ?>"></td>
                        </tr>
                        <tr>
                            <td>File:</td>

                            <td>
                                <a href="assets/file/feeDocumentFile/<?php echo $product['file']; ?>"><?php echo $product['file'] ?></a>
                            </td>

                        </tr>
                        <tr>
                            <td>Cost:</td>
                            <td><?php echo $product['cost'] ?></td>
                        </tr>
                    </table>
            <?php endforeach; ?>

                </td>



        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>