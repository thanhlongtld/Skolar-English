<?php require_once "views/layouts/header.php";?>
<main class="app-content">
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
    <h1>Quản lí biểu ngữ</h1>
    <a class="btn btn-primary" href="index.php?controller=banner&action=create">Thêm mới biểu ngữ</a>
    <a class="btn btn-danger" href="index.php?controller=banner&action=deleteAll" onclick="return confirm('Bạn có chắc muốn xóa hết tất cả dữ liệu không?')">Xóa tất cả dữ liệu </a>
    
        <form method="post" enctype="multipart/form-data" action="index.php?controller=banner&action=deleteChecked">
            <input type="submit" name="checkedValueSubmit" class="btn btn-danger" value="Xóa các mục đã chọn" onclick="return confirm('Bạn có chắc muốn xóa những mục này không?')" >
            <br>
            <br>
            <table class="table">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Banner</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($banners)): ?>
                    <?php foreach ($banners as $banner): ?>
                        <tr>
                            <td><input type="checkbox" name="tickButton[]" class="form-control" value="<?php echo $banner['id'];?>"></td>
                            <td><?php echo $banner['id'];?></td>
                            <td><?php echo $banner['banner'];?></td>
                            <td>
                                <?php
                                switch ($banner['type']){
                                    case Banner::BANNER_MAIN: echo "Biểu ngữ chính";
                                        break;
                                    case Banner::BANNER_EXTRA: echo "Biểu ngữ phụ";
                                        break;
                                }
                                ?>
                            </td>
                            <td><?php echo $banner['description'];?></td>
                            <td><?php echo date('d-m-Y H:i:s',strtotime($banner['created_at']));?></td>
                            <td>
                                <?php
                                switch ($banner['status']){
                                    case Banner::STATUS_ENABLED: echo "Active";
                                        break;
                                    case Banner::STATUS_DISABLED: echo "Inactive";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <!--        --><?php
                                $urlDetail="index.php?controller=banner&action=detail&id=".$banner['id'];
                                $urlUpdate="index.php?controller=banner&action=update&id=".$banner['id'];
                                $urlDelete="index.php?controller=banner&action=delete&id=".$banner['id'];
                                //        ?>
                                <a href="<?php echo $urlDetail?>"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo $urlUpdate?>"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo $urlDelete?>" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này ko?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else:?>
                    <tr>
                        <td colspan="8" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
   
  
</main>
<?php require_once "views/layouts/footer.php";?>
