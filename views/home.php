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

    <div class="collection-list-next">
        <?php foreach ($randoms as $random) { ?>
            <img class="item" src="<?= UPLOAD.$random->image ?>" alt="">
        <?php } ?>
    </div>

    <div class="title-arrival">
        <h1><a href="">New Books</a></h1>
        <hr>
    </div>

    <div class="new-arrivals">
        <div class="arrivals">
            <?php foreach ($books as $book) { ?>
                <div class="item">
                    <div class="item-select">
                        <a href="<?= URL . "book/detail/" . $book->book_id ?>"><img src="<?= UPLOAD . $book->image ?>" alt=""></a>
                        <img class="new" src="<?= IMG ?>logo-new.png" alt="new">
                        <div class="button-menu">
                            <a class="button-select" href="<?= URL . "book/detail/" . $book->book_id ?>"><i class="fas fa-cart-plus"></i></a>

                            <?php if (isset($_SESSION["user"])) { ?>
                                <?php foreach ($likes as $like) {
                                    if ($like->book_id == $book->book_id) { 
                                        $love = true;
                                    }
                                } ?>
                            <?php }  ?>

                            <?php if (isset($_SESSION["user"])) { ?>
                                <a class="button-select" href="<?= $love ? URL . "book/unlike/" . $book->book_id : URL . "book/like/" . $book->book_id ?>"><i <?= $love ? 'style="color:red"' : 'far'; ?> class="<?= $love ? 'fas' : 'far'; ?> fa-heart"></i></a>
                            <?php } else { ?>
                                <a class="button-select" href="<?= URL . "book/like/" . $book->book_id ?>"><i class="far fa-heart"></i></a>
                            <?php } ?>

                        </div>
                    </div>
                    <p class="book-price"><?= $book->price ?> <u>đ</u></p>
                    <p class="book-name"><?= $book->title ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="title-arrival">
        <h1><a href="">Tin Tức Mỗi Ngày</a></h1>
        <hr>
    </div>
    <div class="news-everyday">
        <div class="slideshow">
            <img class="item-slide" src="<?= IMG ?>background4.png" alt="">
        </div>

        <div class="featured-news">
            <h3>Bài Viết Xem Nhất</h3>
            <div class="news">
                <img src="<?= IMG ?>book-sale.jpg" alt="">
                <div class="content">
                    <a class="content-news" href="">Lorem ipsum dolor...</a>
                    <p>15 10 2021</p>
                    <a class="type-news" href="">Sách Kinh Dị</a>
                </div>
            </div>
            <div class="news">
                <img src="<?= IMG ?>book-sale.jpg" alt="">
                <div class="content">
                    <a class="content-news" href="">Lorem ipsum dolor...</a>
                    <p>15 10 2021</p>
                    <a class="type-news" href="">Khuyến Mãi</a>
                </div>
            </div>
            <div class="news">
                <img src="<?= IMG ?>book-sale.jpg" alt="">
                <div class="content">
                    <a class="content-news" href="">Lorem ipsum dolor...</a>
                    <p>15 10 2021</p>
                    <a class="type-news" href="">Khuyến Mãi</a>
                </div>
            </div>
            <div class="news">
                <img src="<?= IMG ?>book-sale.jpg" alt="">
                <div class="content">
                    <a class="content-news" href="">Lorem ipsum dolor...</a>
                    <p>15 10 2021</p>
                    <a class="type-news" href="">Truyện Tranh</a>
                </div>
            </div>

        </div>
    </div>
</div>