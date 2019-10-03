<?php include_once "views/layouts/header.php"; ?>
<?php include_once "views/cart/slide.php"; ?>
<script>
    $(document).ready(function () {

            $("#method").onclick(function () {
                $("#bank").innerHTML("<lable>Nhập số tài khoản của bạn: </lable>" +
                    "<input type='text' class='form-control' name='userBankNumber'>" +
                    "<input type='text' class='form-control' name='userBank'> ");
            })

    })
</script>
<?php $count = 1;
$_SESSION['total'] = 0;
?>
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
<div class="container">
    <div class="row">
        <div class="col-md-6 col-12" >

            <h2 style="text-align: center">Thông tin người mua hàng</h2>
            <form method="post" class="form-group">
                <label>Tên</label>
                <input type="text" name="buyerName" class="form-control" value="<?php echo isset($_POST['buyerName'])? $_POST['buyerName']: " " ?>">
                <label>Số điện thoại: (hãy bỏ số 0 ở đầu số điện thoại của bạn)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">+84</span>
                    </div>
                    <input type="text" class="form-control" name="buyerNumber" value="<?php echo isset($_POST['buyerNumber'])? $_POST['buyerNumber']: " " ?>">
                </div>
                <label>Email:</label>
                <input type="email" name="buyerEmail" class="form-control" value="<?php echo isset($_POST['buyerEmail'])? $_POST['buyerEmail']: " " ?>">
                <label>Địa chỉ:</label>
                <input type="text" name="buyerAddress" class="form-control" value="<?php echo isset($_POST['buyerAddress'])? $_POST['buyerAddress']: " " ?>">
                <label>Tỉnh, thành Phố:</label>
                <?php
                $selectedHN = "";
                $selectedHP = "";
                $selectedSG = "";
                    if (isset($_POST['buyerCity'])) {

                        switch ($_POST['buyerCity']){
                            case Cart::ID_HN:
                                $selectedHN="selected=true";
                                break
                                ;
                            case Cart::ID_HP:
                                $selectedHP="selected=true";
                                break
                                ;
                            case Cart::ID_SG:
                                $selectedSG="selected=true";
                                break
                                ;
                        }
                    }

                ?>
                <br>
                <select name="buyerCity" class="form-control">
                    <option <?php echo $selectedHN ?> value="<?php echo Cart::ID_HN ?>">Hà Nội (30k ship)</option>
                    <option <?php echo $selectedHP ?> value="<?php echo Cart::ID_HP ?>">Hải Phòng (50k ship) </option>
                    <option <?php echo $selectedSG ?> value="<?php echo Cart::ID_SG?>">Sài Gòn (100k ship) </option>
                </select>
                <br>
                <br>
                <label>Hình thức thanh toán:</label>
                <br>
                <?php
                $selectedCod="";
                $selectedBank="";
                    if (isset($_POST['paymentMethod'])){

                        switch ($_POST['paymentMethod']){
                            case Cart::METHOD_COD:
                                $selectedCod="selected=true";
                                break;
                            case Cart::METHOD_BANK:
                                $selectedBank="selected=true";
                                break;
                        }
                    }
                ?>
                <select name="paymentMethod" class="form-control" >
                    <option <?php echo $selectedCod ?> value="<?php echo Cart::METHOD_COD ?>">Thanh toán khi nhận hàng</option>
                    <option <?php echo $selectedCod ?> value="<?php echo Cart::METHOD_BANK ?>" id="method">Chuyển khoản (miễn phí giao hàng)</option>
                </select>
                <br>
                <br>
                <br>
                <div id="bank"></div>
                <label>Số tài khoản(nếu bạn dùng phương thức chuyển khoản):</label>
                <input type="text" name="buyerBankNumber" class="form-control">
                <label>Ngân hàng (nếu bạn dùng phương thức chuyển khoản):</label>
                <input type="text" name="buyerBank" class="form-control">
                <label>Lời nhắn: </label>
                <textarea class="form-control" name="buyerMessage"><?php echo isset($_POST['buyerMessage'])? $_POST['buyerMessage']: " " ?></textarea>
                <br>
                <button type="submit" name="submit" class="form-control">Xác nhận mua hàng</button>

            </form>
        </div>
        <div class="col-md-6 col-12" >
            <h2 style="text-align: center">Các sản phẩm đã chọn</h2>
            <table class="table table-dark">

                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>

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
                                <td><?php echo $_SESSION['number'][$selectedCart['id']] ?></td>
                                <td><?php echo $_SESSION['eachTotal'][$selectedCart['id']]; ?></td>

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


                    </form>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Chưa có gì trong giở hàng của bạn</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $count = 1;

$_SESSION['total']=0;
?>
<?php include_once "views/layouts/footer.php"; ?>
