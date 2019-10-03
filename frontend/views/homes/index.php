<?php require_once "views/layouts/header.php"; ?>
<?php require_once "views/homes/slide.php"; ?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success'] ?>
        <?php unset($_SESSION['success']); ?>
    </div>

<?php endif; ?>
<?php if (isset($_SESSION['fail'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['fail'] ?>
        <?php unset($_SESSION['fail']); ?>
    </div>

<?php endif; ?>
    <section class="courses_area p_120">
        <div class="container">
            <div class="main_title">
                <h2>Các khóa học</h2>
                <p>Các khóa học đều có 2 hình thức: tại lớp hoặc online trực tiếp với giáo viên.</p>
            </div>
            <div class="row courses_inner">
                <div class="col-lg-9">
                    <div class="grid_inner">
                        <?php if (!empty($courses)): ?>
                        <?php foreach ($courses

                        as $course): ?>
                        <?php if ($course['type'] == Course::COURSE_BIG && $course['status'] == Course::STATUS_ENABLED): ?>
                            <div class="grid_item wd55">
                                <div class="courses_item">
                                    <img src="../backend/assets/imguploads/courseAvatar/<?php echo $course['avatar']; ?>"
                                         alt="">
                                    <div class="hover_text">

                                        <a href="#"><h4><?php echo $course['name'] ?></h4></a>
                                        <ul class="list">
                                            <li><a href="#"><i
                                                            class="lnr lnr-users"></i> <?php echo $course['number_of_student'] ?>
                                                    /<?php echo $course['max_number_student'] ?></a></li>

                                            <li><a href="#"><i
                                                            class="lnr lnr-user"></i> <?php echo $course['teacher'] ?>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($course['type'] == Course::COURSE_SMALL && $course['status'] == Course::STATUS_ENABLED): ?>
                            <div class="grid_item wd44">
                                <div class="courses_item">
                                    <img src="../backend/assets/imguploads/courseAvatar/<?php echo $course['avatar']; ?>"
                                         alt="">
                                    <div class="hover_text">

                                        <a href="#"><h4><?php echo $course['name'] ?></h4></a>
                                        <ul class="list">
                                            <li><a href="#"><i
                                                            class="lnr lnr-users"></i> <?php echo $course['number_of_student'] ?>
                                                    /<?php echo $course['max_number_student'] ?></a></li>

                                            <li><a href="#"><i
                                                            class="lnr lnr-user"></i> <?php echo $course['teacher'] ?>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($course['type'] == Course::COURSE_THIN && $course['status'] == Course::STATUS_ENABLED): ?>


                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="course_item">
                        <img src="../backend/assets/imguploads/courseAvatar/<?php echo $course['avatar']; ?>" alt="">
                        <div class="hover_text">

                            <a href="#"><h4><?php echo $course['name'] ?></h4></a>
                            <ul class="list">
                                <li><a href="#"><i class="lnr lnr-users"></i> <?php echo $course['number_of_student'] ?>
                                        /<?php echo $course['max_number_student'] ?></a></li>

                                <li><a href="#"><i class="lnr lnr-user"></i><?php echo $course['teacher'] ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php if (!empty($teachers)): ?>
    <section class="team_area p_120">

        <div class="container">
            <div class="main_title">
                <h2>Đội ngũ giảng viên</h2>
                <p>Chuyên nghiệp, tận tụy, nhiệt tình</p>
            </div>
            <div class="row team_inner">
                <?php foreach ($teachers as $teacher): ?>
                    <?php if ($teacher['status'] == Teacher::STATUS_ENABLED): ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="team_item">
                                <div class="team_img">
                                    <img class="rounded-circle"
                                         src="../backend/assets/imguploads/teacherAvatar/<?php echo $teacher['avatar'] ?>"
                                         alt="">
                                    <div class="hover">
                                        <a href="<?php echo $teacher['facebook'] ?>"><i class="fa fa-facebook"></i></a>
                                        <a href="<?php echo $teacher['twitter'] ?>"><i class="fa fa-twitter"></i></a>
                                        <a href="<?php echo $teacher['instagram'] ?>"><i
                                                    class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="team_name">
                                    <h4><?php echo $teacher['name'] ?></h4>
                                    <p><?php echo $teacher['position'] ?></p>
                                    <p><?php echo $teacher['date_of_birth'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

    </section>
<?php endif; ?>
<?php if (!empty($teachers)): ?>
    <section class="testimonials_area p_120">
        <div class="container">
            <div class="testi_slider owl-carousel">
                <?php foreach ($teachers as $teacher): ?>
                    <?php if ($teacher['status'] == Teacher::STATUS_ENABLED): ?>
                        <div class="item">
                            <div class="testi_item">
                                <img src="../backend/assets/imguploads/teacherAvatar/<?php echo $teacher['avatar'] ?>"
                                     alt="">
                                <h4><?php echo $teacher['name']; ?></h4>

                                <?php echo $teacher['achievement']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
<?php endif; ?>

<?php require_once "views/layouts/footer.php"; ?>