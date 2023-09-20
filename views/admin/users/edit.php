<div class="container">
    <div class="block-content books">
        <div class="edit__title" style="text-align: center;">
            <h1 style=" margin-top: 20px; display: inline-block;">Sửa thông tin người dùng</h1>
        </div>
        <form action="<?= URL; ?>admin/user/edit/1/<?= $user_id; ?>" enctype="multipart/form-data" method="post" style="">

            <?= Security::csrf_token(); ?>

            <div class="edit__content">
                <label for="email">Email:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="email" name="email" value="<?= $data->email ?>" required>
            </div>

            <div class="edit__content">
                <label for="password">Mật khẩu:</label>
                <input value="" style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="password" name="password" required>
            </div>

            <div class="edit__content">
                <label for="fullname">Họ và tên</label>
                <input value="<?= $data->fullname ?>" style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="fullname" name="fullname" required>
            </div>

            <div class="edit__content">
                <label for="address">Địa chỉ:</label>
                <textarea type="text" name="address" required><?= $data->address ?></textarea>
            </div>

            <div class="edit__content">
                <label for="tel">Số điện thoại:</label>
                <input value="<?= $data->tel ?>" style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="number" name="tel" required>
            </div>

            <div class="edit__content">
                <label for="role">Quyền:</label>
                <select name="role">
                    <option value="User" <?php if($data->role =="User") { echo "selected"; } ?>>Người dùng</option>
                    <option value="Admin" <?php if($data->role =="Admin") { echo "selected"; } ?>>Quản trị viên</option>
                </select>
            </div>

            <div class="edit__content" style="justify-content: center;">
                <Button type="submit">Sửa</Button><br>
            </div>

        </form>
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
    </div>

</div>