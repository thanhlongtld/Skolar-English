<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu có ID là <?php echo $id;?></h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $teacher['id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $teacher['name'];?></td>
            </tr>
            <tr>
                <td>Birthday</td>
                <td><?php echo $teacher['date_of_birth'];?></td>
            </tr>
            <tr>
                <td>Position</td>
                <td><?php echo $teacher['position'];?></td>
            </tr>
            <tr>
                <td>Avatar</td>
                <td><img width="300" src="assets/imguploads/teacherAvatar/<?php echo $teacher['avatar'];?>"></td>
            </tr>
            <tr>
                <td>Facebook</td>
                <td><?php echo $teacher['facebook'];?></td>
            </tr>
            <tr>
                <td>Instagram</td>
                <td><?php echo $teacher['instagram'];?></td>
            </tr>
            <tr>
                <td>Twitter</td>
                <td><?php echo $teacher['twitter'];?></td>
            </tr>
            <tr>
                <td>Achievement</td>
                <td><?php echo $teacher['achievement'];?></td>
            </tr>

            <tr>
                <td>Description</td>
                <td><?php echo $teacher['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo date("d-m-Y H:i:s",strtotime($teacher['created_at']));?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($teacher['status']){
                        case Teacher::STATUS_ENABLED: echo "Active";
                            break;
                        case Teacher::STATUS_DISABLED: echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>