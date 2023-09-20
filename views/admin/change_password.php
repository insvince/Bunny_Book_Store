<div class="container">
    <div class="block-content change-password">
        <div class="edit__title" style="text-align: center;">
            <h1 style=" margin-top: 20px; display: inline-block;">Đổi mật khẩu</h1>
        </div>
        <form action="<?= URL; ?>admin/change_password" enctype="multipart/form-data" method="post" style="">

            <?= Security::csrf_token(); ?>

            <div class="edit__content">
                <label for="current_password">Mật khẩu hiện tại:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 20%;" type="password" name="current_password" required>
            </div>

            <div class="edit__content">
                <label for="new_password">Mật khẩu mới:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 20%;" type="password" name="new_password" required>
            </div>

            <div class="edit__content">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 20%;" type="password" name="confirm_password" required>
            </div>


            <div class="edit__content" style="justify-content: center;">
                <Button type="submit">Đổi mật khẩu</Button><br>
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