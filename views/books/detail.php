<div id="main">
    <div class="slideshow">
        <img src="<?= IMG ?>background5.png" alt="">
    </div>
    <?php if (isset($_SESSION["login_error"])) : ?>
        <div class="alert alert-danger" style="margin-top:30px;">
            <?= $_SESSION["login_error"]; ?>
        </div>
    <?php unset($_SESSION["login_error"]);
    endif; ?>

    <?php if (isset($message) && !empty($message)) : ?>
        <div class="alert alert-success" style="margin-top:30px;">
            <?= $message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["login_success"])) : ?>
        <div class="alert alert-success" style="margin-top:30px;">
            <?= $_SESSION["login_success"]; ?>
        </div>
    <?php unset($_SESSION["login_success"]);
    endif; ?>
    <div class="detail" class="">
        <h1>Chi Tiết Sản Phẩm</h1>
        <div class="detail2">
            <div class="img-box">
                <img src="<?= UPLOAD . $book->image ?>" alt="">
            </div>
            <div class="content-box">
                <div class="title">
                    <p><?= $book->title ?></p>
                </div>
                <div class="price">
                    <p><?= $book->price ?> đ</p>
                </div>
                <div class="description">
                    <h3>Mô tả ngắn: </h3>
                    <p><?= $book->description ?></p>
                </div>
                <div class="stock">
                    <h3>Còn lại: </h3>
                    <p style="margin: 10px;"><?= $book->stock ?> Sản phẩm</p>
                </div>
                <form action="<?= URL."book/buy/".$book->id ?>" method="post">
                    <div class="amount">
                        <h3>Số lượng: </h3>
                        <input name="amount" type="number" value="1">
                    </div>
                    <div class="payment">
                        <h3>Phương thức thanh toán: </h3>
                        <select style="padding: 10px 20px" name="payment">
                            <option value="E-payment">E-payment</option>
                            <option value="Cash payment">Cash payment</option>
                        </select>
                    </div>
                    <div class="btn-buy">
                        <button type="submit">Mua ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="related">
        <h3>Liên quan</h3>
        <div class="related2">
            <?php foreach ($relateds as $related) { ?>
                <div class="related2-sub">
                    <div class="related2-sub2">
                        <a href="<?= URL . "book/detail/" . $related->id ?>">
                            <img src="<?= UPLOAD . $related->image ?>" alt="related">
                        </a>
                    </div>
                    <div class="sub2">
                        <p><?= $related->title ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
    .detail {
        min-height: 400px;
        padding: 40px 0;
    }

    .detail h1 {
        width: 90%;
        text-align: center;
        padding: 10px 0;
    }

    .detail2 {
        background-color: #e9e9e9;
        width: 80%;
        min-height: 350px;
        margin: 0 auto;
        padding: 40px;
        border-radius: 10px;
    }

    .detail2 .img-box {
        width: 30%;
        float: left;
    }

    .detail2 .img-box img {
        width: 250px;
    }

    .detail2 .content-box {
        width: 70%;
        float: left;
    }

    .detail2 .content-box .title {
        font-size: 1.5rem;
        font-weight: bolder;
    }

    .detail2 .content-box .price {
        font-size: 1.5rem;
        font-weight: bolder;
    }

    .detail2 .content-box .price p {
        margin: 5px 0;
    }

    .detail2 .content-box .description p {
        min-height: 80px;
    }

    .detail2 .content-box .stock {
        display: flex;
        align-items: center;
    }

    .detail2 .content-box .stock p {
        margin: 10px;
    }

    .detail2 .content-box .amount {
        display: flex;
        align-items: center;
    }

    .detail2 .content-box .amount input {
        margin: 10px;
        padding: 10px;
        width: 50px;
        text-align: center;
    }

    .detail2 .content-box .btn-buy button {
        padding: 5px 20px;
        font-size: 1.2rem;
        margin: 5px 10px;
        background-color: black;
        color: whitesmoke;
        cursor: pointer;
    }

    .related {
        width: 80%;
        margin: 0 auto 50px;
    }

    .related h3 {
        margin: 20px 0;
        font-size: 1.4rem;
    }

    .related2 {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        background-color: whitesmoke;
        border-radius: 10px;
    }

    .related2-sub2 {
        margin: 5px 0;
    }

    .related2-sub2 img {
        width: 150px
    }

    .related2-sub2 p {
        font-weight: bolder;
        margin: 5px 0;
    }

    .related2-sub .sub2 p {
        font-weight: bolder;
    }
</style>