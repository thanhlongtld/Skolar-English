<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu có ID là <?php echo $id;?></h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $freeDocument['id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $freeDocument['name'];?></td>
            </tr>
            <tr>
                <td>Banner</td>
                <td><?php echo $freeDocument['banner'];?></td>
            </tr>

            <tr>
                <td>Avatar</td>
                <td><img width="300" src="assets/imguploads/freeDocumentAvatar/<?php echo $freeDocument['avatar'];?>"></td>
            </tr>
            <tr>
                <td>File</td>
                <td><a href="assets/files/freeDocumentFile/<?php echo $freeDocument['file'] ?>"><?php echo $freeDocument['file'] ?></a></td>
            </tr>
            <tr>
                <td>Introduction</td>
                <td><?php echo $freeDocument['introduction'];?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $freeDocument['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo date("d-m-Y H:i:s",strtotime($freeDocument['created_at']));?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($freeDocument['status']){
                        case Document::STATUS_ENABLED: echo "Active";
                            break;
                        case Document::STATUS_DISABLED: echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>