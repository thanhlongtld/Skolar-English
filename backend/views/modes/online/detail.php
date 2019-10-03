<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu</h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $online[0]['id'];?></td>
            </tr>

            <tr>
                <td>Main banner</td>
                <td><?php echo $online[0]['main_banner'];?></td>
            </tr>
            <tr>
                <td>Extra banner</td>
                <td><?php echo $online[0]['extra_banner'];?></td>
            </tr>
            <tr>
                <td>Video</td>
                <td><?php echo $online[0]['video'];?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $online[0]['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo $online[0]['created_at'];?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($online[0]['status']){
                        case Mode::STATUS_ENABLED: echo "Active";
                            break;
                        case Mode::STATUS_DISABLED: echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>