<div class="container">
    <div class="block-content categories">

        <div class="title__edit" style=" text-align: center;">
            <h1 style="margin-top: 50px; display: inline-block;">Edit Category</h1>
        </div>
        <form action="<?= URL; ?>admin/category/edit/1/<?= $category_id ?>" method="post" style="">

            <?= Security::csrf_token(); ?>
            <input style="padding: 10px;border: 1px solid black;border-radius: 10px;width: 30%;" type="text" name="name" value="<?= $category->name ?>" required>
            <Button type="submit">Edit</Button><br>
        </form>
        
        <?php
        if (!empty($error)) {
        ?>
            <div>
                <p sytle="margin: 10px auto;" class="error-msg"><?= $error; ?></p>
            </div>
        <?php
        }

        if (!empty($message)) {
        ?>
            <div>
                <p sytle="margin: 10px auto;" class="success-msg"><?= $message; ?></p>
            </div>
        <?php
        }
        ?>
    </div>

</div>