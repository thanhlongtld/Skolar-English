<section class="home_banner_area">
    <div class="banner_inner d-flex align-items-center">
        <?php if ($mainpic[0]['status'] == Mainpic::STATUS_ENABLED): ?>
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                 data-background=""
                 style="background: url(../backend/assets/imguploads/mainpic/<?php echo $mainpic[0]['name'] ?>) no-repeat scroll center center;"></div>
        <?php else: ?>
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                 data-background=""></div>
        <?php endif; ?>
        <div class="container">
            <div class="banner_content text-center">
                <?php foreach ($banners as $banner): ?>
                    <?php if ($banner['type'] == Banner::BANNER_MAIN): ?>
                        <?php echo $banner['banner']; ?>
                    <?php elseif ($banner['type'] == Banner::BANNER_EXTRA): ?>
                        <?php echo $banner['banner'] ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a class="main_btn" href="index.php?controller=about&action=index">Get Started</a>
            </div>
        </div>
    </div>
</section>