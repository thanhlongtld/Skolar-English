<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../backend/assets/imguploads/logo/<?php echo $logo[0]['logo_name'] ?>" type="image/png">
    <title>Skolar English</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/linericon/style.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="assets/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="assets/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="assets/vendors/popup/magnific-popup.css">
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<!--================Header Menu Area =================-->
<!--<header class="header_area">-->
<!--    <p>sadasdasdsad</p>-->
<!--</header>-->
<header class="header_area">
    <!--    <div class="top_menu row m0">-->
    <!--        <p>sadasdsad</p>-->
    <!--    </div>-->
<!--    <div>-->
<!--        sadasdasdsd-->
<!--    </div>-->
    <div class="top_menu row m0">

        <div class="container">
            <div class="float-left">
                <ul class="list header_social">
                    <?php foreach ($contacts as $contact): ?>
                    <?php if ($contact['name']=='facebook'&&$contact['status']==Contact::STATUS_ENABLED): ?>
                    <li><a href="<?php echo $contact['value']; ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php elseif ($contact['name']=='twitter'&&$contact['status']==Contact::STATUS_ENABLED):?>
                    <li><a href="<?php echo $contact['value'];?>"><i class="fa fa-twitter"></i></a></li>
                    <?php elseif ($contact['name']=='instagram'&&$contact['status']==Contact::STATUS_ENABLED):?>
                    <li><a href="<?php echo $contact['value']; ?>"><i class="fa fa-instagram"></i></a></li>
                    <?php elseif ($contact['name']=='sdt'&&$contact['status']==Contact::STATUS_ENABLED):?>
                    <a class="dn_btn" href="tel:<?php echo $contact['value']?>"><?php echo $contact['value']?></a>
                    <?php elseif ($contact['name']=='mail'&&$contact['status']==Contact::STATUS_ENABLED):?>
                    <a class="dn_btn" href="mailto:<?php echo $contact['value']?>"><?php echo $contact['value']?></a>
                    <?php endif;?>
                    <?php endforeach;?>

                </ul>
            </div>
            <?php if (isset($_SESSION['username'])):?>
            <div class="float-right">
                <nav class="navbar navbar-expand-lg navbar-light" style="height: 50px;">
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">

                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="assets/imguploads/avatar/<?php echo $_SESSION['avatar']; ?>" width="50px">
                            <span><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="index.php?controller=user&action=detail&username=<?php echo $_SESSION['username'] ?>" >Thông tin tài khoản</a>
                            <li class="nav-item"><a class="nav-link" href="index.php?controller=user&action=logout">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
                </nav>
            </div>
            <?php else:?>
            <div class="float-right">
            <a class="btn btn-warning" href="index.php?controller=user&action=login">
                Đăng nhập
            </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.php?controller=home&action=index"><img src="../backend/assets/imguploads/logo/<?php echo $logo[0]['logo_name'] ?>" alt=""> <span style="font-weight: bold; color: #f66605">Skolar English</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.php?controller=home&action=index">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=about&action=index">About</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="index.php?controller=course&action=onlineIndex">Online</a>
                                <li class="nav-item"><a class="nav-link" href="index.php?controller=course&action=offlineIndex">In person</a></li>
                            </ul>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Document</a>
                            <ul class="dropdown-menu">
                                <?php if(isset($_SESSION['username'])): ?>
                                <li class="nav-item"><a class="nav-link" href="index.php?controller=document&action=freeIndex">Free</a>
                                <?php else :?>
                                <li class="nav-item"><a class="nav-link" href="index.php?controller=user&action=login" onclick="return confirm('Bạn cần đăng nhập để xem nội dung này')">Free</a>
                                <?php endif;?>
                                <li class="nav-item"><a class="nav-link" href="index.php?controller=document&action=feeCart">Chargeable</a></li>

                            </ul>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>