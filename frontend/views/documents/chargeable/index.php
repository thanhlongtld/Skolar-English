<?php include_once "views/layouts/header.php"?>
<?php include_once "views/documents/free/slide.php"?>
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
<br>
<br>

    <a class="btn btn-primary" style="margin-left:45%" href="index.php?controller=cart&action=index"><i class="fa fa-shopping-cart"></i> Giỏ hàng của bạn</a>
    <h1 style="text-align: center; padding-top: 5%; padding-bottom: 5%">Các tài liệu tính phí</h1>
<?php if (isset($feeDocuments)): ?>
    <?php foreach ($feeDocuments as $feeDocument): ?>
    <form method="post" action="index.php?controller=document&action=feeCart" enctype="multipart/form-data">
        <div class="card" style="width: 50%; margin: auto">
            <div class="card-header">
                <?php echo $feeDocument['name']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $feeDocument['banner']; ?></h5>
                <img src="../backend/assets/imguploads/feeDocumentAvatar/<?php echo $feeDocument['avatar']; ?>" width="100%">
                <p class="card-text"><?php echo $feeDocument['introduction']?></p>
                <p class="card-text">Cost: <?php echo $feeDocument['cost'] ?></p>
            <button class="btn btn-primary" type="submit" value="<?php echo $feeDocument['id'] ?>" name="cartSubmit"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
            </div>
        </div>
    </form>
    <?php endforeach;?>
<?php else: ?>
    <h2 style="text-align: center">Hiện tại chưa có tài liệu!</h2>
<?php endif; ?>
    <br>
    <br>
<?php include_once "views/layouts/footer.php"?>