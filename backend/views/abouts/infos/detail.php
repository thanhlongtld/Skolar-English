<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu có ID là <?php echo $id;?></h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $info['id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $info['name'];?></td>
            </tr>
            <tr>
                <td>Value</td>
                <td><?php echo $info['value'];?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $info['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo $info['created_at'];?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($info['status']){
                        case Info::STATUS_ENABLED: echo "Active";
                            break;
                        case Info::STATUS_DISABLED: echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>