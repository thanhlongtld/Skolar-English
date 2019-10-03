<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu có ID là <?php echo $id;?></h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $feeDocument['id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $feeDocument['name'];?></td>
            </tr>
            <tr>
                <td>Banner</td>
                <td><?php echo $feeDocument['banner'];?></td>
            </tr>

            <tr>
                <td>Avatar</td>
                <td><img width="300" src="assets/imguploads/feeDocumentAvatar/<?php echo $feeDocument['avatar'];?>"></td>
            </tr>
            <tr>
                <td>File:</td>
                <td><a href="assets/file/feeDocumentFile/<?php echo $feeDocument['file']; ?>"><?php echo $feeDocument['file'] ?></a></td>
            </tr>
            <tr>
                <td>Introduction</td>
                <td><?php echo $feeDocument['introduction'];?></td>
            </tr>
            <tr>
                <td>Cost</td>
                <td><?php
                    $controller=new Controller();
                    $feeDocumentCost= $controller->my_money_format($feeDocument['cost']);
                    echo $feeDocumentCost;
                    ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $feeDocument['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo date("d-m-Y H:i:s",strtotime($feeDocument['created_at']));?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($feeDocument['status']){
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