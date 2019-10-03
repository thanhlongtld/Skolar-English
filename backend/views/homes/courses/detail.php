<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <h1>Thông tin chi tiết của dữ liệu có ID là <?php echo $id;?></h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $course['id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $course['name'];?></td>
            </tr>
            <tr>
                <td>Number of students</td>
                <td><?php echo $course['number_of_student'];?></td>
            </tr>
            <tr>
                <td>Number of students max</td>
                <td><?php echo $course['max_number_student'];?></td>
            </tr>
            <tr>
                <td>Teacher</td>
                <td><?php echo $course['teacher'];?></td>
            </tr>
            <tr>
                <td>Avatar</td>
                <td><img width="300" src="assets/imguploads/courseAvatar/<?php echo $course['avatar'];?>"></td>
            </tr>
            <tr>
                <td>Type</td>

                <td>
                    <?php
                    switch ($course['type']){
                        case Course::COURSE_THIN: echo "Thẳng đứng";
                            break;
                        case Course::COURSE_BIG: echo "Ngang to";
                            break;
                        case Course::COURSE_SMALL: echo "Ngang nhỏ";
                            break;
                    }
                    ?>
                </td>

            </tr>
            <tr>
                <td>Description</td>
                <td><?php echo $course['description'];?></td>
            </tr>
            <tr>
                <td>Created at</td>
                <td><?php echo date("d-m-Y H:i:s",strtotime($course['created_at']));?></td>
            </tr>
            <tr>
                <td>Status</td>

                <td>
                    <?php
                    switch ($course['status']){
                        case Course::STATUS_ENABLED: echo "Active";
                            break;
                        case Course::STATUS_DISABLED: echo "Inactive";
                            break;
                    }
                    ?>
                </td>

            </tr>
        </table>
    </main>
<?php require_once "views/layouts/footer.php"; ?>