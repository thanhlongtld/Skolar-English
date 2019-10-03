<?php include_once "views/layouts/header.php"?>
<?php include_once "views/documents/free/slide.php"?>
<h1 style="text-align: center; padding-top: 5%; padding-bottom: 5%">Các tài liệu có thể download miễn phí</h1>
<?php if (isset($freeDocuments)): ?>
<?php foreach ($freeDocuments as $freeDocument): ?>
    <div class="card" style="width: 50%; margin: auto">
        <div class="card-header">
            <?php echo $freeDocument['name']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $freeDocument['banner']; ?></h5>
            <img src="../backend/assets/imguploads/freeDocumentAvatar/<?php echo $freeDocument['avatar']; ?>" width="100%">
            <p class="card-text"><?php echo $freeDocument['introduction']?></p>
            <a href="../backend/assets/files/freeDocumentFile/<?php echo $freeDocument['file'] ?>" class="btn btn-primary">Download</a>
        </div>
    </div>
    <?php endforeach;?>
<?php else: ?>
    <h2 style="text-align: center">Hiện tại chưa có tài liệu!</h2>
<?php endif; ?>
<br>
<br>
<?php include_once "views/layouts/footer.php"?>