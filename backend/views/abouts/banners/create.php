<?php require_once "views/layouts/header.php";?>
<main class="app-content">
    <?php if (isset($_SESSION['error'])):?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error'];?>
            <?php unset($_SESSION['error']);?>
        </div>
    <?php endif;?>
    <h1>Bảng thêm mới biểu ngữ</h1>
    <form method="post" enctype="multipart/form-data" action="">
        <label style="font-weight: bold">Banner:</label>
        <textarea id="banner-text" class="form-control" name="bannerText" autofocus>
                <?php echo isset($_POST['bannerText']) ? $_POST['bannerText']: "" ?>
            </textarea>
        <label style="font-weight: bold">Type:</label>
        <select class="form-control" name="bannerType">
            <?php
            $selectedTypeMain = '';
            $selectedTypeExtra = '';
            if (isset($_POST['bannerType'])){

                switch ($_POST['bannerType']){
                    case Banner::BANNER_MAIN:
                        $selectedTypeMain = "selected=true";
                        break;
                    case Banner::BANNER_EXTRA:
                        $selectedTypeExtra = "selected=true";
                        break;
                }
            }
            ?>
            <option <?php echo $selectedTypeMain?>value="<?php echo Banner::BANNER_MAIN ?>">Biểu ngữ chính</option>
            <option  <?php echo $selectedTypeExtra ?>value="<?php echo Banner::BANNER_EXTRA ?>">Biểu ngữ phụ</option>
        </select>
        <label style="font-weight: bold">Description:</label>
        <textarea id="banner-description" class="form-control" name="bannerDescription" autofocus>
                <?php echo isset($_POST['bannerDescription']) ? $_POST['bannerDescription']: "" ?>
            </textarea>
        <label style="font-weight: bold">Status:</label>
        <select class="form-control" name="bannerStatus">
            <?php
            $selectedStatusEnabled = '';
            $selectedStatusDisabled = '';
            if (isset($_POST['bannerStatus'])){

                switch ($_POST['bannerStatus']){
                    case Banner::STATUS_ENABLED:
                        $selectedStatusEnabled = "selected=true";
                        break;
                    case Banner::STATUS_DISABLED:
                        $selectedStatusDisabled = "selected=true";
                        break;
                }
            }
            ?>
            <option <?php echo $selectedStatusEnabled?>value="<?php echo Banner::STATUS_ENABLED ?>">Enable</option>
            <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Banner::STATUS_DISABLED ?>">Disable</option>
        </select>
        <br>
        <br>
        <input type="submit" class="btn btn-success" value="Save" name="banner-submit">
        <a href="index.php?controller=banner&action=aboutIndex" class="btn btn-secondary">Cancel</a>
    </form>
</main>
<?php require_once "views/layouts/footer.php";?>
