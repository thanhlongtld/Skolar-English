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
            <input class="form-control" type="text" name="freeDocumentName"
                   value="<?php echo isset($_POST['freeDocumentName']) ? $_POST['freeDocumentName'] : $freeDocument['name'] ?>">
            <label style="font-weight: bold">Banner:</label>
            <input class="form-control" type="text" name="freeDocumentBanner"
                   value="<?php echo isset($_POST['freeDocumentBanner']) ? $_POST['freeDocumentBanner'] : $freeDocument['banner'] ?>">
            <label style="font-weight: bold">Avatar:</label>
            <input type="file" class="form-control" name="freeDocumentAvatar">
            <img src="assets/imguploads/freeDocumentAvatar/<?php echo $freeDocument['avatar']; ?>" width="80px">
            <label style="font-weight: bold">File:</label>
            <input type="file" class="form-control" name="freeDocumentFile">

            <label style="font-weight: bold">Introduction:</label>
            <textarea id="freeDocument-introduction" class="form-control" name="freeDocumentIntroduction" autofocus>
                <?php echo isset($_POST['freeDocumentIntroduction']) ? $_POST['freeDocumentIntroduction']: $freeDocument['introduction'] ?>
            </textarea>
            <label style="font-weight: bold">Description:</label>
            <textarea id="freeDocument-description" class="form-control" name="freeDocumentDescription" autofocus>
                <?php echo isset($_POST['freeDocumentDescription']) ? $_POST['freeDocumentDescription']: $freeDocument['description'] ?>
            </textarea>

            <?php

            $freeDocumentStatus=isset($_POST['freeDocumentStatus'])? $_POST['freeDocumentStatus']: $freeDocument['status'];

                switch ($freeDocumentStatus){
                    case Document::STATUS_ENABLED:
                        $selectedStatusEnabled = "selected=true";
                        break;
                    case Document::STATUS_DISABLED:
                        $selectedStatusDisabled = "selected=true";
                        break;
                }

            ?>
            <label>Status</label>
            <select class="form-control" name="freeDocumentStatus">

                <option <?php echo $selectedStatusEnabled?> value="<?php echo Document::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?> value="<?php echo Document::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="free-submit">
            <a href="index.php?controller=document&action=freeIndex" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>