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

    <div class="title-arrival">
        <h1><a href="">All Books</a></h1>
        <hr>
    </div>

    <div class="new-arrivals">
        <div class="arrivals">
            <?php foreach ($books as $book) { $love = false ?>
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
    <?php if (ceil($all_books / 12) > 1) { ?>
            <div class="pagination">
                <?php if ($page == 1) { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" class="active">Prev</a>
                <?php } else { ?>
                    <a style="border-radius: 5px 0px 0px 5px;" href="<?= URL; ?>book/all/<?= $page - 1; ?>">Prev</a>
                <?php } ?>

                <?php for ($i = 1; $i <= ceil($all_books / 12); $i++) { ?>
                    <?php if ($i == $page) { ?>
                        <a class="active"><?= $i; ?></a>
                    <?php } else { ?>
                        <a href="<?= URL; ?>book/all/<?= $i; ?>"><?= $i; ?></a>
                    <?php } ?>
                <?php } ?>

                <?php if ($page == ceil($all_books / 12)) { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" class="active">Next</a>
                <?php } else { ?>
                    <a style="border-radius: 0px 5px 5px 0px;" href="<?= URL; ?>book/all/<?= $page + 1; ?>">Next</a>
                <?php } ?>
            </div>
        <?php } else if ($all_books == 0) { ?>
            <p class="section-sub-heading text-while">Don't have any book for now!</p>
        <?php } ?>
</div>