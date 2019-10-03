<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu</h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $video[0]['id'];?></td>
            </tr>

            <tr>
                <td>Value</td>
                <td><?php echo $video[0]['value'];?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $video[0]['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo $video[0]['created_at'];?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($video[0]['status']){
                        case Video::STATUS_ENABLED: echo "Active";
                            break;
                        case Video::STATUS_DISABLED: echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>