<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];?>
                <?php unset($_SESSION['error']);?>
            </div>
        <?php endif;?>
        <h1>Bảng thêm mới dữ liệu:</h1>
        <form class="form-group" method="post" enctype="multipart/form-data" action="">
            <label style="font-weight: bold">Name:</label>
            <input class="form-control" type="text" name="feeDocumentName"
                   value="<?php echo isset($_POST['feeDocumentName']) ? $_POST['feeDocumentName'] : $feeDocument['name'] ?>">
            <label style="font-weight: bold">Banner:</label>
            <input class="form-control" type="text" name="feeDocumentBanner"
                   value="<?php echo isset($_POST['feeDocumentBanner']) ? $_POST['feeDocumentBanner'] : $feeDocument['banner'] ?>">
            <label style="font-weight: bold">Avatar:</label>
            <input type="file" class="form-control" name="feeDocumentAvatar">
            <img src="assets/imguploads/feeDocumentAvatar/<?php echo $feeDocument['avatar']; ?>" width="80px">
            <label style="font-weight: bold">File:</label>
            <input type="file" class="form-control" name="feeDocumentFile">
            <label style="font-weight: bold">Introduction:</label>
            <textarea id="feeDocument-introduction" class="form-control" name="feeDocumentIntroduction" autofocus>
                <?php echo isset($_POST['feeDocumentIntroduction']) ? $_POST['feeDocumentIntroduction']: $feeDocument['introduction'] ?>
            </textarea>
            <label>Cost:</label>
            <input type="number" class="form-control" name="feeDocumentCost">
            <label style="font-weight: bold">Description:</label>
            <textarea id="feeDocument-description" class="form-control" name="feeDocumentDescription" autofocus>
                <?php echo isset($_POST['feeDocumentDescription']) ? $_POST['feeDocumentDescription']: $feeDocument['description'] ?>
            </textarea>

            <?php

            $feeDocumentStatus=isset($_POST['feeDocumentStatus'])? $_POST['feeDocumentStatus']: $feeDocument['status'];

            switch ($feeDocumentStatus){
                case Document::STATUS_ENABLED:
                    $selectedStatusEnabled = "selected=true";
                    break;
                case Document::STATUS_DISABLED:
                    $selectedStatusDisabled = "selected=true";
                    break;
            }

            ?>
            <label>Status</label>
            <select class="form-control" name="feeDocumentStatus">

                <option <?php echo $selectedStatusEnabled?> value="<?php echo Document::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?> value="<?php echo Document::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="fee-submit">
            <a href="index.php?controller=document&action=feeIndex" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>