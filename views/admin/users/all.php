<div class="container">
    <div class="block-content books">
        <div class="padding">
            <a class="addbtn" href="<?= URL; ?>admin/user/add">Thêm Quản Trị Viên</a>
            <?php
            if (!empty($error)) {
            ?>
                <div>
                    <p style="margin: 10px auto;" class="error-msg"><?= $error; ?></p>
                </div>
            <?php
            }

            if (!empty($message)) {
            ?>
                <div>
                    <p style="margin: 10px auto;" class="success-msg"><?= $message; ?></p>
                </div>
            <?php
            }
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Họ Tên</th>
                    <th>Địa Chỉ</th>
                    <th>SĐT</th>
                    <th>Quyền Hạn</th>
                    <th>Quản Lý</th>
                </tr>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->fullname ?></td>
                        <td><?= $user->address ?></td>
                        <td><?= $user->tel ?></td>
                        <td><?= $user->role ?></td>
                        <td>
                            <a style="padding:5px; color: blue;" href="<?= URL; ?>admin/user/edit/1/<?= $user->id ?>"><i class="fas fa-edit"></i></a>
                            <a style="padding:5px; color: red;" href="<?= URL; ?>admin/user/delete/1/<?= $user->id ?>" onclick="return confirm('Are you sure you want to delete this category?');"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php if (ceil($all_users / 5) > 1) { ?>
            <div class="pagination">
                <?php if ($page == 1) { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" class="active">Prev</a>
                <?php } else { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" href="<?= URL; ?>admin/book/all/<?= $page - 1; ?>">Prev</a>
                <?php } ?>

                <?php for ($i = 1; $i <= ceil($all_users / 5); $i++) { ?>
                    <?php if ($i == $page) { ?>
                        <a class="active"><?= $i; ?></a>
                    <?php } else { ?>
                        <a href="<?= URL; ?>admin/book/all/<?= $i; ?>"><?= $i; ?></a>
                    <?php } ?>
                <?php } ?>

                <?php if ($page == ceil($all_users / 5)) { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" class="active">Next</a>
                <?php } else { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" href="<?= URL; ?>admin/book/all/<?= $page + 1; ?>">Next</a>
                <?php } ?>
            </div>
        <?php } else if ($all_users == 0) { ?>
            <p class="section-sub-heading text-while">Don't have any book for now!</p>
        <?php } ?>

    </div>
</div>