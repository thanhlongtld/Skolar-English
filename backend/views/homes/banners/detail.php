<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu có ID là <?php echo $id; ?></h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $banner['id']; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $banner['banner']; ?></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>  <?php
                    switch ($banner['type']) {
                        case Banner::BANNER_MAIN:
                            echo "Biểu ngữ chính";
                            break;
                        case Banner::BANNER_EXTRA:
                            echo "Biểu ngữ phụ";
                            break;
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $banner['description']; ?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo $banner['created_at']; ?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($banner['status']) {
                        case Banner::STATUS_ENABLED:
                            echo "Active";
                            break;
                        case Banner::STATUS_DISABLED:
                            echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>