<?php include_once "views/layouts/header.php";?>
<?php include_once "views/user/slide.php";?>
<h1 style="text-align: center">Thông tin tài khoản</h1>
<?php if (isset($userInfo)): ?>
<table>
    <tr>
        <th>Frist Name</th>
        <td><?php echo $userInfo['firstname']; ?></td>
    </tr>
    <tr>
        <th>Last Name</th>
        <td><?php echo $userInfo['lastname']; ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $userInfo['username']; ?></td>
    </tr>

    <tr>
        <th>Avatar</th>
        <td><img src="assets/imguploads/avatar/<?php echo $userInfo['avatar']; ?>" width="100px"></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date("d-m-Y H:i:s",strtotime($userInfo['created_at']));?></td>
    </tr>
</table>
<br>
<a style="margin: 50%" href="index.php?controller=user&action=update&username=<?php echo $_SESSION['username'] ?>"><button type="button" class="btn btn-primary">Sửa thông tin</button></a>
<?php endif;?>
<?php include_once "views/layouts/footer.php";?>