<?php
$admin = $this->get_logged_in_admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê</title>
    <link rel="stylesheet" href="<?= ADMIN_CSS; ?>style.css">
    <script src="https://kit.fontawesome.com/b1f83b8c89.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="main">
        <div id="header">
            <div class="header-content">
                <div class="header-name">
                    <h2>Admin DashBoard</h2>
                </div>
                <div class="header-avatar">
                    <div class="avatar">
                        <img src="<?= ADMIN_IMG ?>logo.png" alt="">
                    </div>
                    <div class="name" style="margin: 0px 40px 0px 10px;">
                        <p><?= $admin->fullname; ?></p>
                    </div>
                    <div class="Logout" style="margin-right: 40px;">
                        <a href="<?= URL ?>admin/change_password" style="text-decoration: none; color:#f7a5f0">Đổi mật khẩu</a>
                    </div>
                    <div class="Logout">
                        <a href="<?= URL ?>admin/logout" style="text-decoration: none; color:#f7a5f0">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="nav-bar">
            <div class="bar-content">
                <div class="name-list">
                    <p>Thanh Điều Hướng</p>
                </div>
                <div class="list-menu">
                    <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'dashboard') ? 'active' : ''; ?>" href="<?= URL ?>admin">Thống kê</a></li>
                    <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'category') ? 'active' : ''; ?>" href="<?= URL ?>admin/category/add">Danh Sách Danh Mục</a></li>
                    <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'book') ? 'active' : ''; ?>" href="<?= URL ?>admin/book/all">Danh Sách Sách</a></li>
                    <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'order') ? 'active' : ''; ?>" href="<?= URL ?>admin/order/all">Danh Sách Đơn Hàng</a></li>
                    <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'user') ? 'active' : ''; ?>" href="<?= URL ?>admin/user/all">Danh Sách Tài Khoản</a></li>
                </div>
            </div>