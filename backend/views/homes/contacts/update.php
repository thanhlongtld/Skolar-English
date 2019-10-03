<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['error'])):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];?>
                <?php unset($_SESSION['error']);?>
            </div>
        <?php endif;?>
        <h1>Bảng điều chỉnh dữ liệu:</h1>
        <form class="form-group" method="post" enctype="multipart/form-data" action="">
            <label style="font-weight: bold">Name:</label>
            <input class="form-control" type="input" name="contactName"
                   value="<?php echo isset($_POST['contactName']) ? $_POST['contactName'] : $contact['name'] ?>">
            <label style="font-weight: bold">Value:</label>
            <input class="form-control" type="input" name="contactValue"
                   value="<?php echo isset($_POST['contactValue']) ? $_POST['contactValue'] : $contact['value'] ?>">
            <label style="font-weight: bold">Description:</label>
            <textarea id="contact-description" class="form-control" name="contactDescription" autofocus>
                <?php echo isset($_POST['contactDescription']) ? $_POST['contactDescription']: $contact['description'] ?>
            </textarea>
            <label>Status</label>
            <?php
            $selectedStatusEnabled = '';
            $selectedStatusDisabled = '';
            $statusContact=isset($_POST['contactStatus']) ? $_POST['contactStatus'] : $contact['status'];


                switch ($statusContact){
                    case Contact::STATUS_ENABLED:
                        $selectedStatusEnabled = "selected=true";
                        break;
                    case Contact::STATUS_DISABLED:
                        $selectedStatusDisabled = "selected=true";
                        break;
                }

            ?>
            <select class="form-control" name="contactStatus">

                <option <?php echo $selectedStatusEnabled?>value="<?php echo Contact::STATUS_ENABLED ?>">Enable</option>
                <option  <?php echo $selectedStatusDisabled ?>value="<?php echo Contact::STATUS_DISABLED ?>">Disable</option>
            </select>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="contact-submit">
            <a href="index.php?controller=contact&action=create" class="btn btn-secondary">Cancel</a>
        </form>
    </main>
<?php require_once "views/layouts/footer.php"; ?>