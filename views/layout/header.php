<!DOCTYPE html>
<html lang="vi-VN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Book of Bunny</title>
    <link rel="icon" href="<?= IMG ?>logo.png" type="image/icon type">
    <script src="https://kit.fontawesome.com/b1f83b8c89.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= CSS ?>style.css">
    <style>
        /* #main .new-arrivals .arrivals .item {
            z-index: -1;
        } */
        #main .title-arrival {
            z-index: 0;
        }

        .item .button-menu {
            opacity: 0;
        }

        .item .button-menu.active {
            opacity: 1;
        }
    </style>
</head>

<body>

    <div id="sidebar">

        <div class="sidebar-content">
            <div id="logo">
                <a href="<?= URL ?>">
                    <img src="<?= IMG ?>logo.png" alt="">
                </a>
            </div>
            <?php if (isset($_SESSION["user"])) { ?>
                <p style="text-align:center">Hello <?= $this->user->fullname ?>!</p>
            <?php } ?>
            <div id="extra">
                <?php if (!isset($_SESSION["user"])) { ?>
                    <button onclick="openLogin()"><i class="far fa-user-circle"></i></button>
                <?php } ?>
                
                <?php if (isset($_SESSION["user"])) { ?>
                    <button onclick="openChange()"><i class="fa fa-key" aria-hidden="true"></i></button>
                    <a href="<?= URL . "home/logout" ?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <div id="modal">
                <div class="modal-content">

                    <!-- form login/đăng nhập -->
                    <div id="modal-login" class="modal-log">
                        <form action="<?= URL ?>home/login" method="post">
                            <div class="header-form">
                                <h1>Đăng Nhập</h1>
                                <button class="close" onclick="closeLogin()">&times;</button>
                            </div>
                            <?php if (isset($_SESSION["login_error"])) : ?>
                                <div class="offset-md-4 col-md-4  alert alert-danger" style="margin-top:30px;width: 60%">
                                    <?= $_SESSION["login_error"]; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($message) && !empty($message)) : ?>
                                <div class="offset-md-4 col-md-4 alert alert-success" style="margin-top:30px;width: 60%">
                                    <?= $message; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION["login_success"])) : ?>
                                <div class="offset-md-4 col-md-4  alert alert-success" style="margin-top:30px;width: 60%">
                                    <?= $_SESSION["login_success"]; ?>
                                </div>
                            <?php endif; ?>
                            <?= Security::csrf_token(); ?>
                            <input type="text" name="email" class="username" placeholder="Email" required />
                            <input type="password" name="password" class="password" placeholder="Mật Khẩu" required />

                            <button>Đăng Nhập</button>
                            <p>
                                Chưa có tài khoản ?
                                <button class="btn-register" onclick="openRegister()">Đăng ký ngay</button>
                            </p>
                        </form>
                    </div>

                    <!-- form register/đăng ký -->
                    <div id="modal-register" class="modal-log">
                        <form action="<?= URL ?>home/register" method="post">
                            <div class="header-form">
                                <h1>Đăng Ký</h1>
                                <button class="close" onclick="closeRegister()">&times;</button>
                            </div>

                            <?php if (isset($_SESSION["login_error"])) : ?>
                                <div class="offset-md-4 col-md-4  alert alert-danger" style="margin-top:30px;width: 60%">
                                    <?= $_SESSION["login_error"]; ?>
                                </div>
                            <?php
                            endif; ?>

                            <?php if (isset($message) && !empty($message)) : ?>
                                <div class="offset-md-4 col-md-4 alert alert-success" style="margin-top:30px;width: 60%">
                                    <?= $message; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION["login_success"])) : ?>
                                <div class="offset-md-4 col-md-4  alert alert-success" style="margin-top:30px;width: 60%">
                                    <?= $_SESSION["login_success"]; ?>
                                </div>
                            <?php
                            endif; ?>

                            <?= Security::csrf_token(); ?>
                            <input type="email" name="email" class="email" placeholder="Email" required />
                            <input type="password" name="password" class="password" placeholder="Mật Khẩu" required />
                            <input type="password" name="re-password" class="re-password" placeholder="Xác Nhận Mật Khẩu" required />
                            <input type="text" name="fullname" class="username" placeholder="Họ Tên" required />
                            <input type="text" name="address" class="username" placeholder="Địa chỉ" required />
                            <input type="number" name="tel" class="username" placeholder="Sđt" required />

                            <button type="submit">Đăng Ký</button>
                            <p>
                                Đã có tài khoản !
                                <button class="btn-login" onclick="openLogin()">Đăng Nhập Ngay</button>
                            </p>
                        </form>
                    </div>

                    <!-- form doi mat khau -->
                    <div id="modal-change" class="modal-log">
                        <form action="<?= URL ?>home/change_password" method="post">
                            <div class="header-form">
                                <h1>Đổi mật khẩu</h1>
                                <button class="close" onclick="closeChange()">&times;</button>
                            </div>

                            <?php if (isset($_SESSION["login_error"])) : ?>
                                <div class="offset-md-4 col-md-4  alert alert-danger" style="margin-top:30px;">
                                    <?= $_SESSION["login_error"]; ?>
                                </div>
                            <?php
                            endif; ?>

                            <?php if (isset($message) && !empty($message)) : ?>
                                <div class="offset-md-4 col-md-4 alert alert-success" style="margin-top:30px;">
                                    <?= $message; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION["login_success"])) : ?>
                                <div class="offset-md-4 col-md-4  alert alert-success" style="margin-top:30px;">
                                    <?= $_SESSION["login_success"]; ?>
                                </div>
                            <?php
                            endif; ?>

                            <?= Security::csrf_token(); ?>
                            <input type="password" name="current_password" class="password" placeholder="Mật Khẩu hiện tại" required />
                            <input type="password" name="new_password" class="password" placeholder="Mật Khẩu mới" required />
                            <input type="password" name="confirm_password" class="re-password" placeholder="Xác Nhận Mật Khẩu" required />


                            <button type="submit">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="" id="overlay"></div>
            <div id="menu-link">
                <h3>Thể Loại Sách</h3>
                <nav>
                    <ul>
                        <li>
                            <a href="<?= URL."book/all" ?>">Tất cả</a>
                        </li>
                        <?php foreach ($categories as $category) { ?>
                            <li>
                                <a href="<?= URL."book/category/".$category->id ?>"><?= $category->name ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div id="sidebar-footer">

            <div class="follow">
                <a target="blank" href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
                <a target="blank" href="https://www.youtube.com"><i class="fab fa-youtube"></i></a>
                <a target="blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                <a target="blank" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="copyright">
                <p>
                    Copyright © All rights reserved.
                </p>
            </div>
        </div>
    </div>