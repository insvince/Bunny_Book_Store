<div class="container">
    <div class="block-content books">
        <div class="edit__title" style="text-align: center;">
            <h1 style=" margin-top: 20px; display: inline-block;">Add Book</h1>
        </div>
        <form action="<?= URL; ?>admin/book/add" enctype="multipart/form-data" method="post" style="">

            <?= Security::csrf_token(); ?>

            <div class="edit__content">
                <label for="title">Tiêu đề:</label>
                <input type="text" name="title" required>
            </div>

            <div class="edit__content">
                <label for="description">Mô tả:</label>
                <textarea type="text" name="description" required></textarea>
            </div>

            <div class="edit__content">
                <label for="category">Danh mục:</label>
                <select name="category">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="edit__content">
                <label for="stock">Kho:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="number" name="stock" required>
            </div>

            <div class="edit__content">
                <label for="price">Giá:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="number" name="price" required>
            </div>

            <div class="edit__content">
                <label for="author">Tác giả:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 50%;" type="text" name="author" required>
            </div>

            <div class="edit__content" style=" text-align: center;">
                <label for="image">Hình Ảnh:</label>
                <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 50%;" type="file" name="image" required>
            </div>
            
            <div class="edit__content" style="justify-content: center;">
                <Button type="submit">Thêm</Button><br>
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