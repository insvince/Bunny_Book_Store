<div class="container">
    <div class="block-content orders">
        <table>
            <tr>
                <th>ID</th>
                <th>Mã Khách Hàng</th>
                <th>Mã Sách</th>
                <th>Số Lượng</th>
                <th>Thời Gian</th>
                <th>Thanh Toán</th>
            </tr>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?= $order->order_id ?></td>
                    <td><?= $order->fullname ?></td>
                    <td><?= $order->title ?></td>
                    <td><?= $order->amount ?></td>
                    <td><?= $order->order_at ?></td>
                    <td><?= $order->payment ?></td>
                </tr>
            <?php } ?>
        </table>

        <?php if (ceil($all_orders / 5) > 1) { ?>
            <div class="pagination">
                <?php if ($page == 1) { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" class="active">Prev</a>
                <?php } else { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" href="<?= URL; ?>admin/book/all/<?= $page - 1; ?>">Prev</a>
                <?php } ?>

                <?php for ($i = 1; $i <= ceil($all_orders / 5); $i++) { ?>
                    <?php if ($i == $page) { ?>
                        <a class="active"><?= $i; ?></a>
                    <?php } else { ?>
                        <a href="<?= URL; ?>admin/book/all/<?= $i; ?>"><?= $i; ?></a>
                    <?php } ?>
                <?php } ?>

                <?php if ($page == ceil($all_orders / 5)) { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" class="active">Next</a>
                <?php } else { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" href="<?= URL; ?>admin/book/all/<?= $page + 1; ?>">Next</a>
                <?php } ?>
            </div>
        <?php } else if ($all_orders == 0) { ?>
            <p style="margin: 0 auto;" class="section-sub-heading text-while">Don't have any book for now!</p>
        <?php } ?>
    </div>
</div>