<div class="container">
    <div class="block-content categories">
        <form action="<?= URL; ?>admin/category/add" method="post">
            <?= Security::csrf_token(); ?>
           
            <div class="block" style="display: flex; justify-content: center;align-item: center;">
                <label for="name"  style="margin: 30px;">Tên Danh Mục: </label>
                <input style="margin: 20px;padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;height: 20px;" type="text" name="name" required>
                <Button type="submit">Thêm</Button><br>
            </div>
        </form>

        <?php
        if (!empty($error)) {
        ?>
            <div style="margin: 10px auto;">
                <p class="error-msg"><?= $error; ?></p>
            </div>
        <?php
        }

        if (!empty($message)) {
        ?>
            <div style="margin: 10px auto;">
                <p class="success-msg"><?= $message; ?></p>
            </div>
        <?php
        }
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Quản Lý</th>
            </tr>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?= $category->id ?></td>
                    <td><?= $category->name ?></td>
                    <td>
                        <a style="padding:5px; color: blue;" href="<?= URL; ?>admin/category/edit/1/<?= $category->id ?>"><i class="fas fa-edit"></i></a>
                        <a style="padding:5px; color: red;" href="<?= URL; ?>admin/category/delete/1/<?= $category->id ?>" onclick="return confirm('Are you sure you want to delete this category?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php if (ceil($count / 5) > 1) { ?>
            <div class="pagination">
                <?php if ($page == 1) { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" class="active">Prev</a>
                <?php } else { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" href="<?= URL; ?>admin/category/add/<?= $page - 1; ?>">Prev</a>
                <?php } ?>

                <?php for ($i = 1; $i <= ceil($count / 5); $i++) { ?>
                    <?php if ($i == $page) { ?>
                        <a class="active"><?= $i; ?></a>
                    <?php } else { ?>
                        <a href="<?= URL; ?>admin/category/add/<?= $i; ?>"><?= $i; ?></a>
                    <?php } ?>
                <?php } ?>

                <?php if ($page == ceil($count / 5)) { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" class="active">Next</a>
                <?php } else { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" href="<?= URL; ?>admin/category/add/<?= $page + 1; ?>">Next</a>
                <?php } ?>
            </div>
        <?php } else if ($count == 0) { ?>
            <p class="section-sub-heading text-while">Don't have any tour for now!</p>
        <?php } ?>

    </div>

</div>